<?php

namespace App\Controller;

use App\Repository\ExternalSiteRepository;
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
    public function index(MetaTagParser               $metaTagParser,
                          UserInfoRepository          $userInfoRepository,
                          ProjectRepository           $projectRepository,
                          ExternalSiteRepository      $externalSiteRepository,
                          ProjectCollectionRepository $projectCollectionRepository,
                          CacheInterface              $cache): Response
    {

        $collections = $cache->get("project_collection", function (ItemInterface $item) use ($projectCollectionRepository) {
            $item->expiresAfter(7200);
            return $projectCollectionRepository->findLanding();
        });

        $userInfo = $cache->get("user_info", function (ItemInterface $item) use ($userInfoRepository) {
            $item->expiresAfter(7200);
            return $userInfoRepository->findActive();
        });

        $projects = $cache->get("projects", function (ItemInterface $item) use ($projectRepository) {
            $item->expiresAfter(7200);
            return $projectRepository->findLanding();
        });

        $sites = $cache->get("external_sites", function (ItemInterface $item) use ($externalSiteRepository) {
            $item->expiresAfter(7200);
            return $externalSiteRepository->findAllForFooter();
        });

        return $this->render('landing/index.html.twig', [
            'metaTags' => $metaTagParser->parse('app_landing'),
            'userInfo' => $userInfo,
            'projects' => $projects,
            'collections' => $collections,
            'sites' => $sites,
        ]);
    }
}