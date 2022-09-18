<?php

namespace App\Controller;


use App\Entity\UserInfo;
use App\Repository\ExternalSiteRepository;
use App\Repository\LanguageRepository;
use App\Repository\ProjectRepository;
use App\Repository\TagRepository;
use App\Repository\UserInfoRepository;
use App\Service\MetaTagParser;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SiteController extends AbstractController
{

    #[Route('/about', name: 'app_about')]
    public function about(LanguageRepository     $languageRepository,
                          EntityManagerInterface $entityManager,
                          ExternalSiteRepository $externalSiteRepository,
                          MetaTagParser          $metaTagParser): Response
    {

        $repository = $entityManager->getRepository(UserInfo::class);
        $user = $repository->findActive();

        $personalSites = $externalSiteRepository->findPersonal();

        return $this->render('site/about.html.twig', [
            'controller_name' => 'SiteController',
            'languages' => $languageRepository->findAllActive(),
            'user' => $user,
            'personalSites' => $personalSites,
            'metaTags' => $metaTagParser->parse('app_about')
        ]);
    }

    #[Route('/navbar', name: 'app_navbar')]
    public function navbarItems(): Response
    {
        return $this->render('fragments/_header.html.twig');
    }

    #[Route('/footer', name: 'app_footer')]
    public function footerItems(ExternalSiteRepository $externalSiteRepository, UserInfoRepository $userInfoRepository): Response
    {
        return $this->render('fragments/_footer.html.twig', [
            'sites' => $externalSiteRepository->findAllForFooter(),
            'userInfo' => $userInfoRepository->findActive()
        ]);
    }

    #[Route('/_services', name: 'app_user_services')]
    public function services(UserInfoRepository $userInfoRepository): Response
    {
        return $this->render('fragments/_services.html.twig', [
            'services' => $userInfoRepository->findActive()?->getService(),
        ]);
    }


    #[Route('/_searchTags', name: 'app_search_tags')]
    public function searchTags(TagRepository $tagRepository, LanguageRepository $languageRepository): Response
    {
        return $this->render('fragments/_searchTags.html.twig', [
            'tags' => $tagRepository->findAllActive(),
            'languages' => $languageRepository->findAllActive()
        ]);
    }

    #[Route('/_userInfo', name: 'app_user_info')]
    public function userInfo(UserInfoRepository $userInfoRepository): Response
    {
        return $this->render('fragments/_about.html.twig', [
            'userInfo' => $userInfoRepository->findActive()
        ]);
    }

    #[Route('/_randomProjects', name: 'app_random_projects')]
    public function randomProjects(Request $request, ProjectRepository $repository): Response
    {
        return $this->render('fragments/_mywork.html.twig', [
            'projects' => $repository->findRandom($request->query->getInt('max', 15))
        ]);
    }
}
