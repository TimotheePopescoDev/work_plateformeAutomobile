<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Parcours;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeRoutesController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/routes', name: 'app_liste_routes')]
    public function index(): Response
    {
        $parcours = $this->entityManager->getRepository(Parcours::class)->findAll();


        return $this->render('liste_routes/index.html.twig', [
            'parcours' => $parcours,
        ]);
    }
}
