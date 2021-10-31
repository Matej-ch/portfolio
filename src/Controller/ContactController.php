<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request): Response
    {
        $defaultData = [];
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class,[
                'required' => true,
                'label' => 'Your name',
                'attr' => ['placeholder' => 'Your name'],
                'constraints' => [
                    new Length(['min' => 3]),
                    new NotBlank()]
            ])
            ->add('email', EmailType::class,[
                'required' => true,
                'label' => 'Email',
                'attr' => ['placeholder' => 'email'],
                'constraints' => [
                    new Email(),
                    new Length(['min' => 3]),
                    new NotBlank()]
            ])
            ->add('website', UrlType::class,[
                'required' => false,
                'label' => 'Your website',
                'attr' => ['placeholder' => 'your website (optional)'],
            ])
            ->add('phone', TextType::class,[
                'required' => false,
                'label' => 'Phone',
                'attr' => ['placeholder' => 'phone (optional)'],
            ])
            ->add('message', TextareaType::class,[
                    'required' => true,
                    'trim' => true,
                    'label' => 'General Message',
                    'attr' => ['placeholder' => 'write your message here'],
                    'constraints' => [
                        new Length(['min' => 3]),
                        new NotBlank()]
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
        }

        return $this->render('contact/show.html.twig',[
            'form' => $form->createView(),
        ]);
    }
}