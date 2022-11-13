<?php

namespace App\Controller;

use App\Repository\UserInfoRepository;
use App\Service\MetaTagParser;
use Gregwar\CaptchaBundle\Type\CaptchaType;
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
    #[Route('/contact-modal', name: 'app_contact_modal')]
    public function contactModal(Request $request): Response
    {
        $form = $this->getForm($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            if ($request->get('fetch')) {
                return new Response(null, 204);
            }
        }

        //422 unprocessable entity
        return $this->render('contact/modal.html.twig', [
            'form' => $form->createView(),
        ], new Response(null, $form->isSubmitted() ? 422 : 200));
    }

    #[Route('/contact', name: 'app_contact')]
    public function show(Request $request, MetaTagParser $metaTagParser, UserInfoRepository $userInfoRepository, string $adminEmail): Response
    {

        $form = $this->getForm($request);

        $userInfo = $userInfoRepository->findActive();

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new \Symfony\Component\Mime\Email())
                ->from($adminEmail)
                ->to($userInfo->getWorkEmail())
                ->subject("Contact from {$data['name']}")
                ->text("{$data['name']} with email {$data['email']}" . $data['message'] . ". From website {$data['website']}");
            dd($data);

            if ($request->get('fetch')) {
                return new Response(null, 204);
            }
        }

        return $this->render('contact/show.html.twig', [
            'form' => $form->createView(),
            'metaTags' => $metaTagParser->parse('app_contact'),
            'userInfo' => $userInfo
        ], new Response(null, $form->isSubmitted() ? 422 : 200));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\Form\FormInterface
     */
    private function getForm(Request $request): \Symfony\Component\Form\FormInterface
    {
        $defaultData = [];
        $form = $this->createFormBuilder($defaultData)
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Your name',
                'attr' => ['placeholder' => 'Your name'],
                'constraints' => [
                    new Length(['min' => 3]),
                    new NotBlank()]
            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Your email',
                'attr' => ['placeholder' => 'Your email'],
                'constraints' => [
                    new Email(),
                    new Length(['min' => 3]),
                    new NotBlank()]
            ])
            ->add('website', UrlType::class, [
                'required' => false,
                'label' => 'Your website',
                'attr' => ['placeholder' => 'Your website (optional)'],
            ])
            ->add('message', TextareaType::class, [
                'required' => true,
                'trim' => true,
                'label' => 'Message body',
                'attr' => ['placeholder' => 'Write your message here'],
                'constraints' => [
                    new Length(['min' => 3]),
                    new NotBlank()]
            ])
            ->add('captcha', CaptchaType::class)
            ->getForm();

        $form->handleRequest($request);
        return $form;
    }
}