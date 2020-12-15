<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\PropertySearch;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertySearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prestation', ChoiceType::class, [
                'choices' => [
                    'Vente' => 'vente',
                    'Location' => 'location'
                ],
                'required' => false,
                'label' => 'Prestation'
            ])
            ->add('type', ChoiceType::class, [
                'choices' => [
                    'Maison' => 'maison',
                    'Appartement' => 'appartement'
                ],
                'required' => false,
                'label' => 'Type de Bien',

            ])
            ->add('city', ChoiceType::class, [
                'choices' => [
                    'Metz' => 'metz',
                    'Thionville' => 'thionville',
                    'Nancy' => 'nancy',
                ],
                'required' => false,
                'label' => 'Ville',
            ])
            /*->add('city', EntityType::class, [
                'choice_label' => 'city',
                'class' => Address::class,
                'choice_attr' =>
                    function($choice){
                        return [
                            'data-address-city' => $choice->getCity()
                        ];
                    }
                ,
                'required' => false,
                'label' => 'Ville',
            ])*/
            ->add('maxPrice', ChoiceType::class, [
                'choices' => [
                    '100 000 €' => 100000,
                    '200 000 €' => 200000,
                    '500 000 €' => 500000,
                    '1 000 000 €' => 1000000,
                ],
                'required' => false,
                'label' => 'Prix Maximum',
                'attr' => [
                    'placeholder' => 'Prix maximal'
                ]
            ])
            ->add('minArea', ChoiceType::class, [
                'choices' => [
                    '20m²' => 20,
                    '40m²' => 40,
                    '60m²' => 60,
                    '80m²' => 80,
                    '100m²' => 100,
                    '150m²' => 150,
                    '200m²' => 200
                ],
                'required' => false,
                'label' => 'Surface Minimum'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PropertySearch::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }
}
