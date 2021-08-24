<?php

namespace App\Controller;

use App\Entity\Language;
use App\Form\LanguageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    #[Route('/language', name: 'language')]
    public function index(): Response
    {
        return $this->render('language/index.html.twig', [
            'controller_name' => 'LanguageController',
        ]);
    }

    #[Route('/language/new', name: 'language_new')]
    public function new(Request $request): Response
    {
        $project = new Language();

        $form = $this->createForm(LanguageType::class, $project);

        return $this->render('language/new.html.twig',['form' => $form->createView()]);
    }
}
