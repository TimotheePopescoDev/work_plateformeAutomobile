<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ModifPermisType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ModifPermisController extends AbstractController
{
    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/permis-ajout', name: 'app_modif_permis')]
    public function index(Request $request, SluggerInterface $slugger): Response
    {
        $client = new User();

        $formpermis = $this->createForm(ModifPermisType::class, $client);

        $formpermis->handleRequest($request);
        if ($formpermis->isSubmitted() && $formpermis->isValid()) {
            $client = $this->getUser();

            $imgr = $formpermis->get('permisrecto')->getData();
            $imgv = $formpermis->get('permisverso')->getData();

            if ($imgr) {
                $originalFilename = pathinfo($imgr->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imgr->guessExtension();

                try {
                    $imgr->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                }
                $client->setPermisrecto($newFilename);
            }


            if ($imgv) {
                $originalFilename = pathinfo($imgv->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imgv->guessExtension();

                try {
                    $imgv->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {

                }
                $client->setPermisverso($newFilename);
            }

            $em = $this->doctrine->getManager();
            $em->persist($client);
            $em->flush();

            return $this->redirectToRoute('app_permis_valide');
        }


        return $this->render('modif_permis/index.html.twig', [
            'formpermis' => $formpermis->createView(),
        ]);


    }
}
