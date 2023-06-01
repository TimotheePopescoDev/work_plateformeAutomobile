<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifChoixType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('choix01', EntityType::class, [
                'class' => Car::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.etat = true')
                        ->orderBy('u.marques', 'ASC');
                },
                'choice_label' => function (Car $car) {
                    return $car->getMarques() . ' ' . $car->getModele() . ' - ' . $car->getEnergies();
                },
            ])
            ->add('choix02', EntityType::class, [
                'class' => Car::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.etat = true')
                        ->orderBy('u.marques', 'ASC');
                },
                'choice_label' => function (Car $car) {
                    return $car->getMarques() . ' ' . $car->getModele() . ' - ' . $car->getEnergies();
                },
            ])
            ->add('choix03', EntityType::class, [
                'class' => Car::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.etat = true')
                        ->orderBy('u.marques', 'ASC');
                },
                'choice_label' => function (Car $car) {
                    return $car->getMarques() . ' ' . $car->getModele() . ' - ' . $car->getEnergies();
                },
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer vos informations",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
