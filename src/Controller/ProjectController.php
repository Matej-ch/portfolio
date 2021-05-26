<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController
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
        return new Response(sprintf('Showing specific project "%s"!',ucwords(str_replace('-',' ',$slug))));
    }
}