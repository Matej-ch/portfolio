<?php

namespace App\Controller;

use App\Repository\ExternalSiteRepository;
use App\Repository\LanguageRepository;
use App\Repository\ProjectCollectionRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserInfoRepository;
use App\Service\MetaTagParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Contracts\Cache\ItemInterface;

class LandingController extends AbstractController
{
    #[Route('/', name: 'app_landing')]
    public function index(
        UserInfoRepository          $userInfoRepository,
        ProjectRepository           $projectRepository,
        ExternalSiteRepository      $externalSiteRepository,
        ProjectCollectionRepository $projectCollectionRepository,
        CacheInterface              $cache,
        MetaTagParser               $metaTagParser,
        LanguageRepository          $languageRepository): Response
    {

        $sites = $cache->get("external.sites", function (ItemInterface $item) use ($externalSiteRepository) {
            $item->expiresAfter(7200);

            return $externalSiteRepository->findAllForFooter();
        });

        $userInfo = $cache->get("user.info", function (ItemInterface $item) use ($userInfoRepository) {
            $item->expiresAfter(7200);

            return $userInfoRepository->findActive();
        });

        $projects = $cache->get("projects", function (ItemInterface $item) use ($projectRepository) {
            $item->expiresAfter(7200);
            return $projectRepository->findLanding();
        });

        $collections = $cache->get("project.collection", function (ItemInterface $item) use ($projectCollectionRepository) {
            $item->expiresAfter(7200);
            return $projectCollectionRepository->findLanding();
        });

        return $this->render('landing/index.html.twig', [
            'userInfo' => $userInfo,
            'projects' => $projects,
            'collections' => $collections,
            'sites' => $sites,
            'languages' => $languageRepository->findAllActive(),
            'metaTags' => $metaTagParser->parse('app_landing'),
        ]);
    }
}