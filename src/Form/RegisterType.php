<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\Length;


class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom', TextType::class, [
                'label' => 'Votre prénom',

                'constraints' => new Length([
                    'min' => 2,
                    'max' => 70,
                ]),
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre prénom',
                ]
            ])
            ->add('nom', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 70,
                ]),
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre nom'
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre email',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 70,
                ]),
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre email',
                    'class' => 'placeholder-custom'
                ]
            ])
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => "Le mot de passe et la confirmation doivent être identique.",
                'label' => 'Votre mot de passe',
                'constraints' => new Length([
                    'min' => 2,
                    'max' => 70,
                ]),
                'required' => true,
                'first_options' => [
                    'label' => 'Mot de passe',
                    'attr' => [
                        'placeholder' => 'Votre mot de passe',
                        'class' => 'placeholder-custom'
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'constraints' => new Length([
                        'min' => 2,
                        'max' => 70,
                    ]),
                    'attr' => [
                        'placeholder' => 'Confirmer votre mot de passe',

                    ],
                ],

            ])
            ->add('submit', SubmitType::class, [
                'label' => "S'inscrire",
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
