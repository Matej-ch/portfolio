<?php


namespace App\Controller;


use Symfony\Component\HttpFoundation\Response;

class ProjectController
{
    public function index()
    {
        return new Response('Project controller');
    }
}