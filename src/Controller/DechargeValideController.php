<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DechargeValideController extends AbstractController
{
    #[Route('/account/decharge-valide', name: 'app_decharge_valide')]
    public function index(): Response
    {
        return $this->render('decharge/dechargevalide.html.twig', [
            'controller_name' => 'DechargeValideController',
        ]);
    }
}
