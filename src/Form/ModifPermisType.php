<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class ModifPermisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('permisrecto', FileType::class, [
                'required' => false,
                'label' => 'Permis de conduire recto (png, jpg, jpeg)',
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez entrer un document valide de type jpg,jpeg,png',
                    ])
                ]
            ])
            ->add('permisverso', FileType::class, [
                'required' => false,
                'label' => 'Permis de conduire verso (png, jpg, jpeg)',
                'constraints' => [
                    new File([
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez entrer un document valide de type jpg,jpeg,png ',
                    ])
                ]
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
