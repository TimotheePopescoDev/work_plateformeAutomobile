<?php

namespace App\Form;

use App\Entity\Car;
use App\Entity\User;
use App\Entity\Essais;
use App\Entity\Parcours;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EssaisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('conducteur', EntityType::class, [
                    'class' => User::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.etat = true')
                            ->andwhere('u.roles IN (:role)')
                            ->setParameter('role', array('[]'))
                            ->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => function (User $clients) {

                                if ($clients->getPermisrecto() and $clients->getPermisverso()) {
                                    return ' V - ' . $clients->getId() . ' - ' . $clients->getNom() . ' ' . $clients->getPrenom();
                                } else {
                                    return ' X - ' . $clients->getId() . ' - ' . $clients->getNom() . ' ' . $clients->getPrenom();
                                }
                    },
                ]
            )

            ->add('passager01', EntityType::class, [
                    'required' => false,
                    'class' => User::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.etat = true')
                            ->andwhere('u.roles IN (:role)')
                            ->setParameter('role', array('[]'))
                            ->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => function (User $clients) {
                        if ($clients->getPermisrecto() and $clients->getPermisverso()){
                            return ' V - ' . $clients->getId() . ' - ' . $clients->getNom(). ' ' . $clients->getPrenom();
                        }
                        else{
                            return ' X - ' .$clients->getId() . ' - ' . $clients->getNom(). ' ' . $clients->getPrenom();
                        }
                    },

                ]
            )
            /* ->add('passager02', EntityType::class, [
                    'required' => false,
                    'class' => Clients::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.etat = true')
                            ->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => function (Clients $clients) {
                        return $clients->getId() . ' - ' . $clients->getEmail();
                    },
                ]
            )
            ->add('passager03', EntityType::class, [
                    'required' => false,
                    'class' => Clients::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.etat = true')
                            ->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => function (Clients $clients) {
                        return $clients->getId() . ' - ' . $clients->getEmail();
                    },
                ]
            )
            ->add('passager04', EntityType::class, [
                    'required' => false,
                    'class' => Clients::class,
                    'query_builder' => function (EntityRepository $er) {
                        return $er->createQueryBuilder('u')
                            ->where('u.etat = true')
                            ->orderBy('u.id', 'ASC');
                    },
                    'choice_label' => function (Clients $clients) {
                        return $clients->getId() . ' - ' . $clients->getEmail();
                    },
                ]
            ) */
            ->add('voiture', EntityType::class, [
                'class' => Car::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.etat = true')
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => function (Car $car) {
                    return $car->getMarques() . ' ' . $car->getModele(). ' - ' . $car->getEnergies() . ' - ' . $car->getImmatriculation();
                },
            ])
            ->add('route', EntityType::class, [
                'class' => Parcours::class,
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.dispo = true')
                        ->orderBy('u.id', 'ASC');
                },
                'choice_label' => function (Parcours $routes) {
                    return $routes->getNom();
                },
            ])
            ->add('submit', SubmitType::class, [
                'label' => "Envoyer",
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Essais::class,
        ]);
    }
}
