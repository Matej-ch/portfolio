<?php

namespace App\Controller;

use App\Service\MetaTagParser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LandingController extends AbstractController
{
    #[Route('/landing', name: 'app_landing')]
    public function index(MetaTagParser $metaTagParser): Response
    {
        return $this->render('landing/index.html.twig', [
            'metaTags' => $metaTagParser->parse('app_landing')
        ]);
    }
}