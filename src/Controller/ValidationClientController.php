<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ValidationClientController extends AbstractController
{
    #[Route('/validation/client', name: 'app_validation_client')]
    public function index(): Response
    {
        return $this->render('validation_client/index.html.twig', [
            'controller_name' => 'ValidationClientController',
        ]);
    }
}
