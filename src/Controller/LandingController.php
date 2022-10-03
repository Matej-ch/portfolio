<?php

namespace App\Controller;

use App\Repository\ExternalSiteRepository;
use App\Repository\ProjectRepository;
use App\Repository\UserInfoRepository;
use App\Service\MetaTagParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/', name: 'app_landing')]
    public function index(MetaTagParser          $metaTagParser,
                          UserInfoRepository     $userInfoRepository,
                          ProjectRepository      $projectRepository,
                          ExternalSiteRepository $externalSiteRepository): Response
    {
        return $this->render('landing/index.html.twig', [
            'metaTags' => $metaTagParser->parse('app_landing'),
            'userInfo' => $userInfoRepository->findActive(),
            'projects' => $projectRepository->findLanding(),
            'sites' => $externalSiteRepository->findAllForFooter(),
        ]);
    }
}