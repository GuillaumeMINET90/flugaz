<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\TransferContainers;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormError;

class TransferContainerUsedType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder

            ->add('user', EntityType::class, [
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
            ->add('total_weight', NumberType::class, [
                'label' => false,
                'attr' => ['class' => 'form-select-medium'],
                'required'=> false,
            ])
            ->add('gaz', ChoiceType::class, [
                'label' => false,
                'attr' => ['class' => 'form-select-medium'],
                'placeholder' => 'Sélectionner',
                'choices'=> $options['gaz'],
                'required'=> false,

            ])
            ->add('used_container',CheckboxType::class,[
                'label' => 'Réserver cette bouteille',
                'attr' => ['class' => 'form-check'],
                'required'=> false,
                ])
        ;
       
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => TransferContainers::class,
            'gaz' => null,
        ]);
    }
}
