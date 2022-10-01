<?php

namespace App\Form;

use App\Entity\Vendors;
use App\Entity\TransferContainers;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class TransferContainersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('number', IntegerType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,
            ])
            ->add('tare', NumberType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,
            ])
            ->add('purchase_date', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> true,
            ])
            ->add('volume', IntegerType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium'],
                'required'=> true,
            ])
            ->add('vendor', EntityType::class, [
                'label' => false,
                'placeholder' => 'Sélectionner',
                'attr' => ['class' => 'form-select-medium'],
                'class' => Vendors::class,
                'query_builder' => function (EntityRepository $er){
                                    return $er->createQueryBuilder('v')
                                    ->orderBy('v.name', 'ASC');},
                'choice_label' => 'name',
                'required' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TransferContainers::class,
        ]);
    }
}
