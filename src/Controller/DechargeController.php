<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifDechargeType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class DechargeController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }
    
    
    #[Route('/account/decharge', name: 'app_decharge')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $client = new User();

        $formdecharge = $this->createForm(ModifDechargeType::class, $client);

        $formdecharge->handleRequest($request);
        if ($formdecharge->isSubmitted() && $formdecharge->isValid()) {
            $client = $this->getUser();

            $img = $formdecharge->get('decharge')->getData();

            if ($img) {
                $originalFilename = pathinfo($img->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $img->guessExtension();

                try {
                    $img->move(
                        $this->getParameter('files_decharge'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $client->setDecharge($newFilename);
            }


            $em = $this->doctrine->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('app_decharge_valide');
        }
        return $this->render('decharge/index.html.twig', [
            'formdecharge' => $formdecharge->createView(),
        ]);
    }
}
