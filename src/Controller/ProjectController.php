<?php


namespace App\Controller;


use App\Service\MarkdownHelper;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjectController extends AbstractController
{

    /**
     * @Route("/",name="app_homepage")
     */
    public function homepage(MarkdownHelper $markdownHelper): Response
    {

        $text = 'some text';
        return $this->render('project/homepage.html.twig',['text' =>  $markdownHelper->parse($text)]);
    }

    /**
     * @Route("/projects/{slug}",name="app_show")
     */
    public function show($slug): Response
    {
        return $this->render('project/show.html.twig',[
            'question' => ucwords(str_replace('-',' ',$slug)),
            'answers' =>[1,2,3]
        ]);
    }
}