<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifChoixType;
use App\Form\ModifPermisType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ModifChoixController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/choix-ajout', name: 'app_modif_choix')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $client = new User();

        $formchoix = $this->createForm(ModifChoixType::class, $client);

        $formchoix->handleRequest($request);
        if ($formchoix->isSubmitted() && $formchoix->isValid()) {
            $client = $this->getUser();

            $choix01 = $formchoix->get('choix01')->getData();
            $choix02 = $formchoix->get('choix02')->getData();
            $choix03 = $formchoix->get('choix03')->getData();

            if ($choix01) {
                $client->setChoix01($choix01);
            }

            if ($choix02) {
                $client->setChoix02($choix02);
            }

            if ($choix03) {
                $client->setChoix03($choix03);
            }

            $em = $this->doctrine->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('app_choix_valide');
        }


        return $this->render('modif_choix/index.html.twig', [
            'formchoix' => $formchoix->createView(),
        ]);
    }
}
