<?php

namespace App\Controller;

use App\classe\ChangeState;
use App\Entity\Car;
use App\Entity\Essais;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EssaisEnCoursController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/gestion/essais-en-cours', name: 'app_essais')]
    public function index(): Response
    {

        $essais = $this->entityManager->getRepository(Essais::class)->findAll();


        return $this->render('essais_en_cours/index.html.twig', [
            'essais' => $essais
        ]);
    }


    #[Route('/gestion/essais-en-cours/state/{id}', name: 'app_state_essais')]
    public function state(Request $request, ChangeState $changeState, $id): Response
    {
        // Principal Modif
        $changeState->modifstate($id);
        $repo = $this->entityManager->getRepository(Essais::class)->findOneBy(['id' => $id]);

        // A la modif, changer l'état de la voiture
        $voiture = $repo->getVoiture();
        $car = $this->entityManager->getRepository(Car::class)->findOneBy(['id' => $voiture]);
        $statecar = $car->IsEtat();

        // Si pas de besoin de formulaire satisfaction
        /*$client = $repo->getClient();
        $repoclient = $this->entityManager->getRepository(Clients::class)->findOneBy(['id' => $client]);
        $stateclient = $repoclient->IsEtat();

        $passager01 = $repo->getPassager01();
        if ($passager01 != null)
        {
            $repop01 = $this->entityManager->getRepository(Clients::class)->findOneBy(['id' => $passager01]);
            $statep01 = $repop01->IsEtat();
        }*/

        // end Si



        $state = $repo->isEtat();
        if($state == true)
        {
            $state = $repo->setEtat(false);
            $statecar = $car->setEtat(true);

            // Si pas de besoin de formulaire satisfaction
            /*$stateclient = $repoclient->setEtat(true);
            if ($passager01 != null)
            {
               $statep01 = $repop01->setEtat(true);
            }*/
            // end Si
        }
        $em = $this->doctrine->getManager();
        $em->persist($state);
        $em->persist($statecar);


        // Si pas de besoin de formulaire satisfaction
        /*$em->persist($stateclient);
        if ($passager01 != null)
        {
            $em->persist($statep01);
        }*/
        // end Si

        $em->flush();
        return $this->redirectToRoute('app_essais');
    }
}
