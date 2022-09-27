<?php

namespace App\Form;

use App\Entity\Tools;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ToolsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('type')
            ->add('denomination')
            ->add('serial_number')
            ->add('control_date')
            ->add('next_control')
            ->add('control_certificate')
            ->add('technicien')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Tools::class,
        ]);
    }
}
