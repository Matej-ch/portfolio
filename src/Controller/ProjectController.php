<?php


namespace App\Controller;


use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage(): Response
    {
        return $this->render('project/homepage.html.twig');
    }

    /**
     * @Route("/projects/{slug}",name="app_show")
     */
    public function show($slug, LoggerInterface $logger): Response
    {
        $logger->info("Showing project $slug");
        return $this->render('project/show.html.twig',[
            'question' => ucwords(str_replace('-',' ',$slug)),
            'answers' =>[1,2,3]
        ]);
    }
}