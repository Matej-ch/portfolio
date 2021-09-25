<?php

namespace App\Controller;

use App\Repository\LanguageRepository;
use App\Repository\TagRepository;
use App\Repository\UserInfoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Cache\ItemInterface;

class SiteController extends AbstractController
{

    #[Route('/')]
    public function indexNoLocale(): Response
    {
        return $this->redirectToRoute('app_homepage', ['_locale' => 'en']);
    }

    #[Route('/{_locale<%app.supported_locales%>}/', name: 'app_homepage')]
    public function index(): Response
    {
        return $this->render('site/index.html.twig', [
            'controller_name' => 'SiteController',
        ]);
    }

    //#[Route('/{_locale<%app.supported_locales%>}/about', name: 'app_about')]
    #[Route('/about', name: 'app_about')]
    public function about(TagRepository $tagRepository, LanguageRepository $languageRepository, UserInfoRepository $userInfoRepository): Response
    {
        $cache = new FilesystemAdapter();

        $tags = $cache->get('tags_cached', function (ItemInterface $item) use ($tagRepository) {
            $item->expiresAfter(1800);

            return $tagRepository->findAllActive();
        });

        $languages = $languageRepository->findAllActive();

        $user = $userInfoRepository->findActive();

        return $this->render('site/about.html.twig', [
            'controller_name' => 'SiteController',
            'tags' => $tags,
            'languages' => $languages,
            'user' => json_decode($user->data ?? "", true),
            'avatar' => $user->avatar ?? ''
        ]);
    }
}
