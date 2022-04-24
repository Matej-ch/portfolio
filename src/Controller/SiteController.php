<?php

namespace App\Controller;

use App\Entity\ExternalSite;
use App\Entity\UserInfo;
use App\Repository\ExternalSiteRepository;
use App\Repository\LanguageRepository;
use App\Repository\ProjectRepository;
use App\Repository\ServiceRepository;
use App\Repository\TagRepository;
use App\Repository\UserInfoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\ItemInterface;

class SiteController extends AbstractController
{

    /*#[Route('/')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_homepage', ['_locale' => 'en']);
    }*/

    /*#[Route('/{_locale<%app.supported_locales%>}/', name: 'app_homepage')]
    public function index(): Response{}*/

    //#[Route('/{_locale<%app.supported_locales%>}/about', name: 'app_about')]
    #[Route('/about', name: 'app_about')]
    public function about(TagRepository          $tagRepository,
                          LanguageRepository     $languageRepository,
                          EntityManagerInterface $entityManager,
                          ExternalSiteRepository $externalSiteRepository): Response
    {
        $cache = new FilesystemAdapter();

        $tags = $cache->get('tags_cached', function (ItemInterface $item) use ($tagRepository) {
            $item->expiresAfter(1800);

            return $tagRepository->findAllActive();
        });

        $languages = $cache->get('langs_cached', function (ItemInterface $item) use ($languageRepository) {
            $item->expiresAfter(1800);

            return $languageRepository->findAllActive();
        });

        $repository = $entityManager->getRepository(UserInfo::class);
        $user = $repository->findActive();

        $personalSites = $externalSiteRepository->findPersonal();

        return $this->render('site/about.html.twig', [
            'controller_name' => 'SiteController',
            'tags' => $tags,
            'languages' => $languages,
            'user' => $user,
            'personalSites' => $personalSites
        ]);
    }

    #[Route('/navbar', name: 'app_navbar')]
    public function navbarItems(ExternalSiteRepository $externalSiteRepository): Response
    {
        $githubUrl = $externalSiteRepository->findGithub();
        $linkedinUrl = $externalSiteRepository->findLinkedin();

        return $this->render('fragments/_header.html.twig', [
            'github' => $githubUrl['url'] ?? 'https://github.com/',
            'linkedin' => $linkedinUrl['url'] ?? 'https://www.linkedin.com/'
        ]);
    }

    #[Route('/footer', name: 'app_footer')]
    public function footerItems(ExternalSiteRepository $externalSiteRepository): Response
    {
        return $this->render('fragments/_footer.html.twig', [
            'sites' => $externalSiteRepository->findAllForFooter(),
        ]);
    }

    #[Route('/_services', name: 'app_user_services')]
    public function services(ServiceRepository $serviceRepository): Response
    {
        return $this->render('fragments/_services.html.twig', [
            'services' => $serviceRepository->findAll(),
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
    public function randomProjects(Request $request, ProjectRepository $repository)
    {
        return $this->render('fragments/_mywork.html.twig', [
            'projects' => $repository->findRandom($request->query->getInt('max', 15))
        ]);
    }
}
