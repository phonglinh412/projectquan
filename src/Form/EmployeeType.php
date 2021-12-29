<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Employee name',
                    'required' => true,
                    'attr' =>
                    [
                        'minilength' => 15
                    ]
                ]
            )
            ->add(
                'address',
                TextType::class,
                [
                    'label' => 'Employee address',
                    'required' => true,
                    'attr' => [
                        'minlength' => 15
                    ]
                ]
            )
            ->add(
                'contactNumber',
                TextType::class,
                [
                    'label' => 'Employee contactNumber',
                    'required' => true,
                    'widget' => 'single_text'
                ]
            )
            ->add(
                'position',
                TextType::class,
                [
                    'label' => 'Employee position',
                    'required' => true,
                    'attr' =>
                    [
                        'minilength' => 15
                    ]
                ]
            )
            ->add(
                'order',
                EntityType::class,
                [
                    'label' => 'Order',
                    'class' => Order::class,
                    'choice_label' => 'id',
                    'multiple' => true,
                    'expanded' => false
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
