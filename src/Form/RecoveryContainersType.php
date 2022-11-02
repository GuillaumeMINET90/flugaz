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
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class RecoveryContainersType extends AbstractType
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
            ->add('gaz', ChoiceType::class, [
                'label' => false,
                'attr' => ['class' => 'form-the-line-medium-gray'],
                'placeholder' => 'Sélectionner',
                'choices'=> $gaz,
                'required'=> true,
            ])

       
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $e){

            $form = $e->getForm();

            /** @var RecoveryContainers*/
            $data = $e->getData();

            if( !$data->getId()){
                $form
                ->add('number', IntegerType::class, [
                    'label' => false,
                    'attr' => ['class' => 'form-the-line-medium-gray'],
                    'required'=> true,
                ])
                ->add('tare', NumberType::class, [
                    'label' => false,
                    'attr' => ['class' => 'form-the-line-medium-gray'],
                    'required'=> true,
                ])
                ->add('purchase_date', DateType::class, [
                    'label' => false,
                    'widget' => 'single_text',
                    'attr' => ['class' => 'form-datepicker-wiwi-gray'],
                    'required'=> true,
                ])
                ->add('total_weight', NumberType::class, [
                    'label' => false,
                    'attr' => ['class' => 'form-the-line-medium-gray'],
                    'required'=> true,
                ]);    
            }
            if($data->getId()){
                $form
                ->add('return_date', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'attr' => ['class' => 'form-datepicker-wiwi'],
                'required'=> false,
                ]);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RecoveryContainers::class,
        ]);
    }
}
