<?php

namespace App\Controller;

use App\Entity\User;
use DateTimeZone;
use App\Entity\FormSatisfaction;
use App\Form\FormRetourType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FormRetourController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {
        }

    #[Route('/form-retour', name: 'app_form_retour')]
    public function index(Request $request): Response
    {
        $retour = new FormSatisfaction();
        $formretour = $this->createForm(FormRetourType::class, $retour);


        $formretour->handleRequest($request);
        if ($formretour->isSubmitted() && $formretour->isValid()) {
            $date = new \DateTimeImmutable();
            $datef = $date->setTimezone(new DateTimeZone('Europe/Paris'));



            $retour = $formretour->getData();
            $retour->setSentAt($datef);

            if ($retour->getClient()){
                $client = $retour->getClient();
                if ($client->getId() == 11 ){
                    $stateclient = $client->setAvis(false);
                }else{
                    $stateclient = $client->setAvis(true);
                }

            }


            $em = $this->doctrine->getManager();
            $em->persist($retour);
            if ($retour->getClient()) {
                $em->persist($stateclient);
            }
            $em->flush();

            return $this->redirectToRoute('app_validation_retour');
        }

        return $this->render('form_retour/index.html.twig', [
            'formretour' => $formretour->createView(),
        ]);
    }
}
