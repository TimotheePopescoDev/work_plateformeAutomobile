<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChoixValideController extends AbstractController
{
    #[Route('/compte/choix', name: 'app_choix_valide')]
    public function index(): Response
    {
        return $this->render('modif_choix/choixvalid.html.twig', [
            'controller_name' => 'ChoixValideController',
        ]);
    }
}
