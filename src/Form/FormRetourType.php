<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\FormSatisfaction;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FormRetourType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('client', EntityType::class, [
                'class' => User::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.etat = false')
                        ->andwhere('u.roles IN (:role)')
                        ->setParameter('role', array('[]'))
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => function (User $clients) {
                    return $clients->getId() . ' - ' . $clients->getNom() . $clients->getPrenom();
                },
            ])
            ->add('voitures', EntityType::class, [
                'class' => Car::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.marques', 'ASC');
                },
                'choice_label' => function (Car $clients) {
                    return $clients->getMarques() . ' ' . $clients->getModele() . ' - ' . $clients->getEnergies();
                },
            ]
            )
            ->add('avis')
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FormSatisfaction::class,
        ]);
    }
}
