<?php

namespace App\Form;

use App\Entity\TransferContainers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TransferContainersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number')
            ->add('gaz')
            ->add('tare')
            ->add('purchase_date')
            ->add('return_date')
            ->add('total_weight')
            ->add('volume')
            ->add('vendor')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TransferContainers::class,
        ]);
    }
}
