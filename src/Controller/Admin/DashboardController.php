<?php

namespace App\Controller\Admin;

use App\Controller\Admin\SoireeCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }
    public function index(): Response
    {
        return $this->redirect(
            $this->adminUrlGenerator
                ->setController(SoireeCrudController::class)
                ->setAction(Action::INDEX)
                ->generateUrl()
        );

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('GameHub');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Catalogue');
        yield MenuItem::linkTo(SoireeCrudController::class, 'Soirées');
        yield MenuItem::linkTo(JeuCrudController::class, 'Jeux');
        yield MenuItem::linkTo(CategorieCrudController::class, 'Catégories');

        yield MenuItem::section('Gestion des Utilisateurs');
        yield MenuItem::linkTo(UtilisateurCrudController::class, 'Utilisateurs');
        yield MenuItem::linkTo(ReservationCrudController::class, 'Réservations');


    }
}
