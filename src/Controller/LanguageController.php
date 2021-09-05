<?php

namespace App\Controller;

use App\Entity\Language;
use App\Form\LanguageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
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
    public function new(Request $request, string $iconDir): Response
    {
        $language = new Language();

        $form = $this->createForm(LanguageType::class, $language);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $language = $form->getData();

            if ($icon = $form['icon']->getData()) {
                $filename = bin2hex(random_bytes(6)).'.'.$icon->guessExtension();
                try {
                    $icon->move($iconDir, $filename);
                } catch (FileException $e) {
                    // unable to upload the photo, give up
                }
                $language->setPhotoFilename($filename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($language);
            $entityManager->flush();

            $this->addFlash('success', "Language ".$language->getType()." Created!");

            return $this->redirectToRoute('language');
        }

        return $this->render('language/new.html.twig',['form' => $form->createView()]);
    }

    #[Route('/language/{id}/edit', name: 'language_edit')]
    public function edit(Language $language,Request $request, string $iconDir)
    {
        $form = $this->createForm(LanguageType::class, $language);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {

            //$language = $form->getData();

            if ($icon = $form['icon']->getData()) {
                $filename = bin2hex(random_bytes(6)).'.'.$icon->guessExtension();
                try {
                    $icon->move($iconDir, $filename);
                } catch (FileException $e) {
                    // unable to upload the photo, give up
                }
                $language->setPhotoFilename($filename);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($language);
            $entityManager->flush();

            $this->addFlash('success', "Language type ".$language->getType()." Updated!");

            return $this->redirectToRoute('language');
        }

        return $this->render('language/edit.html.twig',['form' => $form->createView(),'language' => $language]);
    }
}
