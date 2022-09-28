<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Tools;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ToolsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {   $type =[
                'Balance' => 'Balance',
                'Détecteur de fuite' => 'Détecteur de fuite',
                'Pompe à vide' => 'Pompe à vide',
                'Manifold' => 'Manifold',
                'Station de récupération' => 'Station de récupération',
                'Thermomètre' => 'Thermomètre',
                'Vacuomètre' => 'Vacuomètre',
            ];

        $builder
            ->add('type', ChoiceType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'placeholder' => 'Sélectionner',
                'choices'=> $type,
                'required'=> true,
            ])
            ->add('denomination', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,             
            ])
            ->add('serial_number', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,             
            ])
            ->add('control_date', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> true,
                ])
            ->add('next_control', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> true,
                ])
            ->add('control_certificate', TextType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> false,             
            ])
            ->add('technicien', EntityType::class, [
                'label' => false,
                'placeholder' => 'Sélectionner',
                'attr' => ['class' => 'form-select-medium'],
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
            'data_class' => Tools::class,
        ]);
    }
}
