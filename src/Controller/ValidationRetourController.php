<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValidationRetourController extends AbstractController
{
    #[Route('/validation/retour', name: 'app_validation_retour')]
    public function index(): Response
    {
        return $this->render('validation_retour/index.html.twig', [
            'controller_name' => 'ValidationRetourController',
        ]);
    }
}
