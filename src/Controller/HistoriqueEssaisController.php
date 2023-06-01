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

class HistoriqueEssaisController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/gestion/essais', name: 'app_essais_complet')]
    public function index(): Response
    {

        $essais = $this->entityManager->getRepository(Essais::class)->findAll();

        return $this->render('historique_essais/index.html.twig', [
            'essais' => $essais
        ]);
    }
    #[Route('/gestion/essais/state/{id}', name: 'app_old_essais')]
    public function state(Request $request, ChangeState $changeState, $id): Response
    {
        $changeState->modifoldstate($id);
        $repo = $this->entityManager->getRepository(Essais::class)->findOneBy(['id' => $id]);
        $state = $repo->isInProgress();
        if($state == true)
        {
            $state = $repo->setInProgress(false);
            $em = $this->doctrine->getManager();
            $em->persist($state);
            $em->flush();
        }
        elseif($state == false)
        {
            $state = $repo->setInProgress(true);
            $em = $this->doctrine->getManager();
            $em->persist($state);
            $em->flush();
        }

        return $this->redirectToRoute('app_essais');
    }

}
