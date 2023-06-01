<?php

namespace App\Form;

use App\classe\Search;
use App\Entity\Car;
use App\Entity\Marques;
use App\Entity\Energy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categories', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Marques::class,
                'multiple' => true,
                'expanded' => true
            ])
            ->add('energy', EntityType::class, [
                'label' => false,
                'required' => false,
                'class' => Energy::class,
                'multiple' => true,
                'expanded' => true
            ])


            ->add('submit', SubmitType::class, [
                'label' => 'Filtrer',
                'attr' => [
                    'class' => 'btn-block btn-info'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'crsf_protection' => false,
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
