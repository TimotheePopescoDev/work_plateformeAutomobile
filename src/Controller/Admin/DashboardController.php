<?php

namespace App\Controller\Admin;

use App\Entity\Car;
use App\Entity\Energy;
use App\Entity\Marques;
use App\Entity\Essais;
use App\Entity\Parcours;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {

    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();
        return $this->redirect($url);


    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Stellantis');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class);
        yield MenuItem::linkToCrud('Voitures', 'fa-solid fa-car', Car::class);
        yield MenuItem::linkToCrud('Energies', 'fa-solid fa-bolt', Energy::class);
        yield MenuItem::linkToCrud('Marques', 'fa-solid fa-copyright', Marques::class);
        yield MenuItem::linkToCrud('Parcours', 'fa-solid fa-road', Parcours::class);
        yield MenuItem::linkToCrud('Essais', 'fa fa-ticket', Essais::class);

    }
}
