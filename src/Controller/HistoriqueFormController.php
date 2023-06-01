<?php

namespace App\Controller;

use App\classe\ChangeState;
use App\Entity\FormSatisfaction;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HistoriqueFormController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/gestion/forms', name: 'app_historique_form')]
    public function index(): Response
    {

        $forms = $this->entityManager->getRepository(FormSatisfaction::class)->findAll();

        return $this->render('historique_form/index.html.twig', [
            'forms' => $forms
        ]);
    }
    #[Route('/gestion/forms/delete/{id}', name: 'app_delete_forms')]
    public function delete(ChangeState $changeState, $id): Response
    {
        $changeState->delete($id);

        $repo = $this->entityManager->getRepository(FormSatisfaction::class)->findOneBy(['id' => $id]);

        $em = $this->doctrine->getManager();
        $em->remove($repo);
        $em->flush();

        return $this->redirectToRoute('app_forms');
    }
}
