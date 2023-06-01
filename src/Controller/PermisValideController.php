<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PermisValideController extends AbstractController
{
    #[Route('/compte/permis', name: 'app_permis_valide')]
    public function index(): Response
    {
        return $this->render('modif_permis/permisvalid.html.twig', [
            'controller_name' => 'PermisValideController',
        ]);
    }
}
