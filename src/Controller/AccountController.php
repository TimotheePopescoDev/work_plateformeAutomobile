<?php

namespace App\Controller;

use App\classe\Mail;
use App\Entity\Essais;
use DateTimeZone;
use App\Form\EssaisType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class AccountController extends AbstractController
{

    public function __construct(private ManagerRegistry $doctrine) {
    }

    #[Route('/gestion', name: 'app_account')]
    public function index(Request $request): Response
    {

        $ajout = new Essais();
        $formajout = $this->createForm(EssaisType::class, $ajout);

        $formajout->handleRequest($request);
        if ($formajout->isSubmitted() && $formajout->isValid()) {
            $date = new \DateTimeImmutable();
            $datef = $date->setTimezone(new DateTimeZone('Europe/Paris'));


            $ajout = $formajout->getData();
            $ajout->setStartedAt($datef);

            $car = $ajout->getVoiture();
            $statecar = $car->setEtat(false);


            $client = $ajout->getConducteur();
            $stateclient = $client->setEtat(false);
            $stateclientavis = $client->setAvis(false);

            $passager01 = $ajout->getPassager01();
            if($passager01 != null)
            {
                $statepassager01 = $passager01->setEtat(false);
                $statepassager01avis = $passager01->setAvis(false);
            }


            $em = $this->doctrine->getManager();
            $em->persist($ajout);
            $em->persist($statecar);
            $em->persist($stateclient);
            $em->persist($stateclientavis);
            if($passager01 != null)
            {
                $em->persist($statepassager01);
                $em->persist($statepassager01avis);
            }

            $em->flush();

            $mail = new Mail();

            $mail->sendRe($client->getEmail(), $client->getNom(), 'Stellantis - Votre avis nous intéresse ! ',$client->getNom());

            if($passager01 != null)
            {
                $mail->sendRe($passager01->getEmail(), $passager01->getNom(), ' Stellantis - Votre avis nous intéresse ! ', $client->getNom() );
            }



            return $this->redirectToRoute('app_essais');
        }
        return $this->render('account/index.html.twig',[
            'formajout' => $formajout->createView(),

        ]);


    }

}
