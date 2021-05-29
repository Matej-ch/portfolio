<?php


namespace App\Service;


use Symfony\Contracts\Cache\CacheInterface;

class MarkdownHelper
{
    private CacheInterface $cache;

    public function __construct(CacheInterface $cache)
    {
        $this->cache = $cache;
    }
    public function parse(string $source): string
    {
        return $this->cache->get('text_'.md5($source),function () use ($source) {
            return $source;
        });
    }
}