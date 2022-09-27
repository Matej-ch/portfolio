<?php

namespace App\Service;

use App\Repository\MetaTagRepository;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class MetaTagParser
{
    public function __construct(private readonly CacheInterface    $metaTagsCache,
                                private readonly MetaTagRepository $metaTagRepository)
    {
    }

    public function parse($pageName)
    {
        $tagRepository = $this->metaTagRepository;
        return $this->metaTagsCache->get("{$pageName}_metaTags", function (ItemInterface $item) use ($tagRepository, $pageName) {
            $item->expiresAfter(1800);

            $parsedTags = [];
            foreach ($tagRepository->findForPage($pageName) as $dbItem) {
                if (!empty($dbItem->getName())) {
                    $parsedTags[$dbItem->getId()]['type'] = 'name';
                    $parsedTags[$dbItem->getId()]['typeContent'] = $dbItem->getName();
                }

                if (!empty($dbItem->getHttpEquiv())) {
                    $parsedTags[$dbItem->getId()]['type'] = 'http-equiv';
                    $parsedTags[$dbItem->getId()]['typeContent'] = $dbItem->getHttpEquiv();
                }

                if (!empty($dbItem->getCharset())) {
                    $parsedTags[$dbItem->getId()]['type'] = 'charset';
                    $parsedTags[$dbItem->getId()]['typeContent'] = $dbItem->getCharset();
                }

                if (!empty($dbItem->getItemprop())) {
                    $parsedTags[$dbItem->getId()]['isItemProp'] = true;
                    $parsedTags[$dbItem->getId()]['typeContent'] = $dbItem->getItemprop();
                }

                $parsedTags[$dbItem->getId()]['content'] = $dbItem->getContent();
            }

            return $parsedTags;
        });
    }
}