<?php

namespace App\Form;

use App\Entity\Immovable;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImmovableType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('type')
            ->add('prestation')
            ->add('address', AddressType::class)
            ->add('price')
            ->add('area')
            ->add('room')
            ->add('bedroom')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Immovable::class,
        ]);
    }
}
