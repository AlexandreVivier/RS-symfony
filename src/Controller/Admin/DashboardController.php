<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Symfony Rs');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Panneau Admin', 'fa fa-scroll');
        yield MenuItem::linkToRoute('Retour au site', 'fa fa-home', 'app_homepage');
        yield MenuItem::linkToCrud('User', 'fas fa-list', UserCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Post', 'fas fa-list', PostCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Category', 'fas fa-list', CategoryCrudController::getEntityFqcn());
    }
}
