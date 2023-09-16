<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{   
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {   
        //fixer le rôle le moins élévé
        if($this->isGranted('ROLE_EDITOR')){
        return $this->render('admin/dashboard.html.twig');
        }else
        return $this->redirectToRoute('app_car');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Revizcar');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Go to site', 'fa-solid fa-arrow-rotate-left','app_car');
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        
        if ($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Cars');
            yield MenuItem::subMenu('Cars', 'fa-solid fa-book-journal-whills')->setSubItems([
                MenuItem::linkToCrud('Create Car', 'fas fa-plus-circle', Car::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Car', 'fas fa-eye', Car::class),
            ]);
        }
        /* if ($this->isGranted('ROLE_EDITOR')){
            yield MenuItem::section('Books');
            yield MenuItem::subMenu('Books', 'fa-solid fa-book')->setSubItems([
                MenuItem::linkToCrud('Create Book', 'fas fa-plus-circle', Book::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Book', 'fas fa-eye', Book::class),
            ]);
        } */
        if ($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Users');
            yield MenuItem::subMenu('Users', 'fa fa-user-circle')->setSubItems([
                MenuItem::linkToCrud('Create User', 'fas fa-plus-circle', User::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show User', 'fas fa-eye', User::class),
            ]);
        }
        /* if ($this->isGranted('ROLE_ADMIN')){
            yield MenuItem::section('Genders');
            yield MenuItem::subMenu('Genders', 'fa-solid fa-sort')->setSubItems([
                MenuItem::linkToCrud('Create Gender', 'fas fa-plus-circle', Gender::class)->setAction(Crud::PAGE_NEW),
                MenuItem::linkToCrud('Show Gender', 'fas fa-eye', Gender::class),
            ]);
        } */
    }
}
