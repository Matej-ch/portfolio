<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use App\Entity\LanguageType;
use App\Entity\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\CrudUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        /*$routeBuilder = $this->get(CrudUrlGenerator::class)->build();
        $url = $routeBuilder->setController(ProjectCrudController::class)->generateUrl();

        return $this->redirect($url);*/
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_homepage');
        yield MenuItem::linkToCrud('Projects', 'fas fa-map-marker-alt', Project::class);
        yield MenuItem::linkToCrud('Languages', 'fas fa-comments', Language::class);
        yield MenuItem::linkToCrud('Types', 'fas fa-comments', LanguageType::class);
    }
}
