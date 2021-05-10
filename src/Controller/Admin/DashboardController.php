<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Books;
use App\Entity\Category;
use App\Controller\Admin\UserCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Digital Library');
    }

    public function configureMenuItems(): iterable
    {
     /*    return [
            MenuItem::section('Dashboard', 'fas fa-cogs')->setSubItems([
            MenuItem::section('Livres', 'fas fa-book'),
            MenuItem::linkToDashboard('Gestion des Livres'),
            MenuItem::section('Gestion des catégories'),
            MenuItem::linkToCrud('Catégories', 'fas fa-tags', Category::class),
            MenuItem::section('Utilisateurs', 'fas fa-user-cog'),
            MenuItem::linkToDashboard('Gestion des utilisateurs'),
            MenuItem::section('Prêts', 'fas fa-shopping-basket'),
            MenuItem::linkToDashboard('Gestion des prêts'),

            ]),
        ]; */

        return [
            MenuItem::subMenu('Tableau de Bord', 'fas fa-cogs'),
                MenuItem::section('gestion des livres', 'fas fa-book'),
                MenuItem::linkToCrud('Livres', 'fa fa-tags', Books::class),
                MenuItem::section('Gestion des catégories', 'fas fa-tags'),
                MenuItem::linkToCrud('Categories', 'fa fa-tags', Category::class),
                MenuItem::section('Gestion des utilisateurs', 'fas fa-user-cog'),
                MenuItem::linkToCrud('Utilisateurs', 'fa fa-tags', User::class),
                MenuItem::section('Prêts', 'fas fa-shopping-basket'),
            // ...
        ];
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
