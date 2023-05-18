<?php

namespace App\Controller\Admin;


use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator
    ){
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(ReservationCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Le Quai Antique');
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('assets/styles/admin.css');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Réservations', 'fa-sharp fa-solid fa-file-pen');
        yield MenuItem::section('Configuration');
        yield MenuItem::linkToCrud('Configuration', 'fa-solid fa-gear', ConfigurationCrudController::getEntityFqcn());
        yield MenuItem::section('Horaires d\'ouverture');
        yield MenuItem::linkToCrud('Horaires d\'ouverture', 'fa-regular fa-clock', OpeningHoursCrudController::getEntityFqcn());
        yield MenuItem::section('A la carte');
        yield MenuItem::linkToCrud('Plats', 'fa-solid fa-utensils', DishesCardCrudController::getEntityFqcn());
        yield MenuItem::section('Menus du restaurant');
        yield MenuItem::linkToCrud('Menus', 'fa-solid fa-book', MenuCrudController::getEntityFqcn());
        yield MenuItem::linkToCrud('Plats', 'fa-solid fa-utensils', DishesMenuCrudController::getEntityFqcn());
        yield MenuItem::section('Galerie d\'images');
        yield MenuItem::linkToCrud('Galerie d\'images', 'fa-sharp fa-regular fa-images', GalleryCrudController::getEntityFqcn());
        yield MenuItem::section('Messages / Demande(s) des clients');
        yield MenuItem::linkToCrud('Messages / Demande(s) des clients', 'fa-solid fa-envelope', ContactCrudController::getEntityFqcn());
    }
}
