<?php

namespace App\Controller;

use App\classe\ChangeState;
use App\Entity\Car;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeVoituresController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/gestion/voitures', name: 'app_voitures')]
    public function index(): Response
    {

        $voitures = $this->entityManager->getRepository(Car::class)->findAll();

        return $this->render('liste_voitures/index.html.twig', [
            'voitures' => $voitures,
        ]);
    }

    #[Route('/gestion/voitures/state/{id}', name: 'app_state_car')]
    public function state(Request $request, ChangeState $changeState, $id): Response
    {
        $changeState->modifoldstate($id);
        $repo = $this->entityManager->getRepository(Car::class)->findOneBy(['id' => $id]);
        $state = $repo->isEtat();
        if($state == true)
        {
            $state = $repo->setEtat(false);
            $em = $this->doctrine->getManager();
            $em->persist($state);
            $em->flush();
        }
        elseif($state == false)
        {
            $state = $repo->setEtat(true);
            $em = $this->doctrine->getManager();
            $em->persist($state);
            $em->flush();
        }

        return $this->redirectToRoute('app_voitures');
    }
    #[Route('/gestion/voitures/delete/{id}', name: 'app_delete_car')]
    public function delete(ChangeState $changeState, $id): Response
    {
        $changeState->delete($id);

        $repo = $this->entityManager->getRepository(Car::class)->findOneBy(['id' => $id]);

        $em = $this->doctrine->getManager();
        $em->remove($repo);
        $em->flush();

        return $this->redirectToRoute('app_voitures');
    }
}
