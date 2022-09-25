<?php

namespace App\Form;

use App\Entity\NewContainers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewContainersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number')
            ->add('gaz')
            ->add('initial_weight')
            ->add('purchase_date')
            ->add('return_date')
            ->add('vendor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewContainers::class,
        ]);
    }
}
