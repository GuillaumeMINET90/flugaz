<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\RecoveryContainers;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use App\Entity\RecoveryContainersMovements;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class RecoveryContainersMovementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantity_recovered', NumberType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,
            ])
            ->add('date', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> true,
                ])
            ->add('cerfa_number', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,             
            ])
            ->add('customer', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,             
            ])
            ->add('remark', TextareaType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> false, 
            ])
            ->add('recovery_container', EntityType::class, [
                'label' => false,
                'placeholder' => 'Sélectionner',
                'attr' => ['class' => 'form-select-medium', 'readonly' => true],
                'class' => RecoveryContainers::class,
                'query_builder' => function (EntityRepository $er){
                                    return $er->createQueryBuilder('c')
                                    ->orderBy('c.number', 'ASC');},
                'choice_label' => 'number',
                'required' => true,
            ])
            ->add('technicien', EntityType::class, [
                'label' => false,
                'placeholder' => 'Sélectionner',
                'attr' => ['class' => 'form-select-medium', 'readonly' => true],
                'class' => User::class,
                'query_builder' => function (EntityRepository $er){
                                    return $er->createQueryBuilder('u')
                                    ->orderBy('u.username', 'ASC');},
                'choice_label' => 'username',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecoveryContainersMovements::class,
        ]);
    }
}
