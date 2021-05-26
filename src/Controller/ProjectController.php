<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    /**
     * @Route("/")
     *
     * @return Response
     */
    public function homepage(): Response
    {
        return new Response('Project controller');
    }

    /**
     * @Route("/projects/{slug}")
     */
    public function show($slug): Response
    {
        return $this->render('project/show.html.twig',[
            'question' => ucwords(str_replace('-',' ',$slug)),
            'answers' =>[1,2,3]
        ]);
    }
}