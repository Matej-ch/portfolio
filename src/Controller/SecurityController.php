<?php

namespace App\Controller;

use App\Entity\Admin;
use Endroid\QrCode\Builder\Builder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Scheb\TwoFactorBundle\Security\TwoFactor\Provider\Totp\TotpAuthenticatorInterface;
use Doctrine\ORM\EntityManagerInterface;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('security/login.html.twig', [
            'error' => $authenticationUtils->getLastAuthenticationError(),
            'last_username' => $authenticationUtils->getLastUsername(),]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route('/authentication/2fa/enable', name: 'app_2fa_enable')]
    #[IsGranted("IS_AUTHENTICATED_FULLY")]
    public function enable2fa(TotpAuthenticatorInterface $totpAuthenticator, EntityManagerInterface $entityManager)
    {
        /** @var Admin $user */
        $user = $this->getUser();
        if (!$user->isTotpAuthenticationEnabled()) {
            $user->setTotpSecret($totpAuthenticator->generateSecret());

            $entityManager->flush();
        }

        return $this->render('security/enable2fa.html.twig');
    }

    #[Route('/authenticate/2fa/qr-code', name: 'app_qr_code')]
    #[IsGranted("ROLE_USER")]
    public function displayGoogleAuthenticatorQrCode(TotpAuthenticatorInterface $totpAuthenticator)
    {
        $qrCodeContent = $totpAuthenticator->getQRContent($this->getUser());
        $result = Builder::create()
            ->data($qrCodeContent)
            ->build();

        return new Response($result->getString(), 200, ['Content-Type' => 'image/png']);
    }
}