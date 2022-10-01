<?php

namespace App\Form;

use App\Entity\RecoveryContainersMovements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecoveryContainersMovementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity_recovered')
            ->add('date')
            ->add('cerfa_number')
            ->add('customer')
            ->add('remark')
            ->add('recovery_container')
            ->add('technicien')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecoveryContainersMovements::class,
        ]);
    }
}
