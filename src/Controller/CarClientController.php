<?php

namespace App\Controller;

use App\classe\Search;
use App\Entity\Car;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CarClientController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/cars', name: 'app_car_client')]
    public function index(Request $request): Response
    {
        $cars = $this->entityManager->getRepository(Car::class)->findAll();

        $search = new Search();
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $cars = $this->entityManager->getRepository(Car::class)->findWithSearch($search);
        }

        return $this->render('car_client/index.html.twig', [
            'cars' => $cars,
            'form' => $form->createView()
        ]);
    }
    #[Route('/car/{slug}', name: 'app_car_shows')]
    public function show($slug): Response
    {
        $car = $this->entityManager->getRepository(Car::class)->findOneBySlug($slug);

        if(!$car){
            return $this->redirectToRoute('app_car_client');
        }
        else{

            return $this->render('car_client/show.html.twig', [
                'car' => $car,
            ]);
        }
    }
}
