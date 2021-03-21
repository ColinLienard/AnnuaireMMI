<?php

namespace App\Controller\Admin;

use App\Entity\Articles;
use App\Entity\Bac;
use App\Entity\Offer;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MMI Space')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Articles', 'far fa-newspaper', Articles::class);
        yield MenuItem::linkToCrud("Offres d'emploi", 'fas fa-file-signature', Offer::class);

        yield MenuItem::section("Utilisateurs");
        yield MenuItem::linkToCrud("Liste","fa fa-users",User::class);
        yield MenuItem::linkToCrud("Bac d'origine","fa fa-graduation-cap", Bac::class);
        //yield MenuItem::linkToCrud('Inviter','fa fa-user-plus');
    }
}
