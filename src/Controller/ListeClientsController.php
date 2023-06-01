<?php

namespace App\Controller;

use App\classe\ChangeState;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ListeClientsController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/gestion/clients', name: 'app_clients')]
    public function index(): Response
    {

        $clients = $this->entityManager->getRepository(User::class)->findAll();

        return $this->render('liste_clients/index.html.twig', [
            'clients' => $clients
        ]);
    }

    #[Route('/gestion/clients/state/{id}', name: 'app_state_client')]
    public function state(Request $request, ChangeState $changeState, $id): Response
    {
        $changeState->modifoldstate($id);
        $repo = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $id]);
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

        return $this->redirectToRoute('app_clients');
    }
    #[Route('/gestion/clients/delete/{id}', name: 'app_delete_client')]
    public function delete(ChangeState $changeState, $id): Response
    {
        $changeState->delete($id);

        $repo = $this->entityManager->getRepository(User::class)->findOneBy(['id' => $id]);

        $em = $this->doctrine->getManager();
        $em->remove($repo);
        $em->flush();

        return $this->redirectToRoute('app_clients');
    }
}
