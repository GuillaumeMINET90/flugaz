<?php

namespace App\Form;

use App\Entity\Vendors;
use App\Entity\RecoveryContainers;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class RecoveryContainersEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
            $gaz =[
                'R32' => 'R32',
                'R134A' => 'R134A',
                'R404A' => 'R404A',
                'R407C' => 'R407C',
                'R410A' => 'R410A',
            ];

        $builder
            ->add('number', IntegerType::class, [
                'label' => false,
                'disabled' => true,
                'attr' => ['class' => 'form-the-line-medium-gray'],
                'required'=> true,
            ])
            ->add('gaz', ChoiceType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium-gray'],
                'placeholder' => 'Sélectionner',
                'choices'=> $gaz,
                'required'=> true,
            ])
            ->add('tare', NumberType::class, [
                'label' => false,
                'disabled' => true,
                'attr' => ['class' => 'form-the-line-medium-gray'],
                'required'=> true,
            ])
            ->add('purchase_date', DateType::class, [
                'label' => false,
                'disabled' => true,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi-gray'],
                'required'=> true,
            ])
            ->add('return_date', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> false,
                ])
            ->add('vendor', EntityType::class, [
                'label' => false,
                'disabled' => true,
                'placeholder' => 'Sélectionner',
                'attr' => ['class' => 'form-select-medium'],
                'class' => Vendors::class,
                'query_builder' => function (EntityRepository $er){
                                    return $er->createQueryBuilder('v')
                                    ->orderBy('v.name', 'ASC');},
                'choice_label' => 'name',
                'required' => true,
            ])
            ->add('total_weight', NumberType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium-gray'],
                'required'=> true,
            ])
       
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecoveryContainers::class,
        ]);
    }
}
