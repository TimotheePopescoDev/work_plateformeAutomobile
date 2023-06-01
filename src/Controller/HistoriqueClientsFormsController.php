<?php

namespace App\Controller;

use App\classe\ChangeState;
use App\Entity\Essais;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueClientsFormsController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/account/mes-essais', name: 'app_mes_forms')]
    public function index(): Response
    {
        $essais = $this->entityManager->getRepository(Essais::class)->findAll();

        return $this->render('historique_clients_forms/index.html.twig', [
            'essais' => $essais
        ]);
    }
}
