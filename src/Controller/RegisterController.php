<?php

namespace App\Controller;

use App\classe\Mail;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use App\Form\RegisterType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;



class RegisterController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager, private ManagerRegistry $doctrine)
    {
        $this->entityManager = $entityManager;
    }


    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, UserPasswordHasherInterface $hasher): Response
    {
        $notification = null;

        $user = new User();
        $form = $this->createForm(RegisterType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $form->getData();
            $search_email = $this->entityManager->getRepository(User::class)->findOneByEmail($user->getEmail());

            if(!$search_email){
                $password = $hasher->hashPassword($user,$user->getPassword());

                $user->setPassword($password);
                $em = $this->doctrine->getManager();
                $em->persist($user);
                $em->flush();

                $mail = new Mail();

                $name = $user->getNom();
                $firstname = $user->getPrenom();
                $id = $user->getId();
                $email = $user->getEmail();
                $mail->send($user->getEmail(), $user->getNom(), 'Merci pour votre inscription !',$user->getNom(),$user->getPrenom(),$user->getId(), $user->getEmail());


                return $this->redirectToRoute('app_validation_client');
            }
            else{
                $notification = "L'email que vous avez renseigné existe déjà ! ";
            }
        }

        return $this->render('register/index.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
        ]);
    }
}
