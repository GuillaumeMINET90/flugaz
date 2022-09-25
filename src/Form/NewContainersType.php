<?php

namespace App\Form;

use App\Entity\NewContainers;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NewContainersType extends AbstractType
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
                'label' => 'N° de bouteille',
                'attr' => ['class' => 'form-the-line'],
                'required'=> true,
            ])
            ->add('gaz', ChoiceType::class, [
                'label' => 'Nature du gaz',
                'attr' => ['class' => 'form-the-line'],
                'placeholder' => 'Sélectionner',
                'choices'=> $gaz,
                'required'=> true,

            ])
            ->add('initial_weight', NumberType::class, [
                'label' => 'Poid du gaz en kg',
                'attr' => ['class' => 'form-the-line'],
                'required'=> true,
            ])
            ->add('purchase_date', DateType::class, [
                'label' => 'Date d\'achat',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> true,
            ])
            ->add('return_date', DateType::class, [
                'label' => 'Date de retour',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> false,
                ])
            ->add('vendor', ChoiceType::class, [
                'label' => 'Fournisseur',
                'attr' => ['class' => 'form-the-line'],
            ])
            ->add('bill_number', TextType::class, [
                'label' => 'N° du bon de livraison',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> false,             
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => NewContainers::class,
        ]);
    }
}
