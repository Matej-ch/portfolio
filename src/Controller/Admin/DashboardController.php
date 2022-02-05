<?php

namespace App\Controller\Admin;

use App\Entity\ExternalSite;
use App\Entity\Language;
use App\Entity\Project;
use App\Entity\ProjectState;
use App\Entity\Service;
use App\Entity\Tag;
use App\Entity\UserInfo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    private AdminUrlGenerator $routeBuilder;

    public function __construct(AdminUrlGenerator $routeBuilder)
    {
        $this->routeBuilder = $routeBuilder;
    }

    //#[IsGranted('ROLE_ADMIN')]
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->redirect($this->routeBuilder->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio')
            ->setFaviconPath('images/favicon-32x32.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToUrl('Back to the website', 'fas fa-home', $this->generateUrl('app_homepage'));

        yield MenuItem::linkToCrud('User info', 'fas fa-map-marker-alt', UserInfo::class);

        yield MenuItem::section('Project');
        yield MenuItem::linkToCrud('Projects', 'fas fa-map-marker-alt', Project::class);
        yield MenuItem::linkToCrud('Project states', 'fas fa-sign', ProjectState::class);
        yield MenuItem::linkToCrud('Languages', 'fas fa-comments', Language::class);

        yield MenuItem::section('Site');
        yield MenuItem::linkToCrud('External sites', 'fas fa-globe', ExternalSite::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Services', 'fas fa-user-tie', Service::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user);
    }
}
