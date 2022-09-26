<?php

namespace App\Form;

use App\Entity\NewContainers;
use Doctrine\ORM\EntityRepository;
use App\Entity\NewContainersMovements;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class NewContainersMovementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('new_container', EntityType::class, [
                'label' => false,
                'placeholder' => 'Sélectionner',
                'attr' => ['class' => 'form-select-medium', 'readonly' => true],
                'class' => NewContainers::class,
                'query_builder' => function (EntityRepository $er){
                                    return $er->createQueryBuilder('c')
                                    ->orderBy('c.number', 'ASC');},
                'choice_label' => 'number',
                'required' => true,
            ])
            ->add('quantity_rest', NumberType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> false,
            ])
            ->add('quantity_injected', NumberType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> false,
            ])
            ->add('date', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> false,
                ])
            ->add('cerfa_number', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> false,             
            ])
            ->add('customer', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> false,             
            ])
            ->add('remark', TextareaType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> false, 
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
            'data_class' => NewContainersMovements::class,
        ]);
    }
}
