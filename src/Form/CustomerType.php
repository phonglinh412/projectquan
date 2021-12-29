<?php

namespace App\Form;

use App\Entity\Customer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'name',
                TextType::class,
                [
                    'label' => 'Customer name',
                    'required' => true,
                    'attr' =>
                    [
                        'minilength' => 15
                    ]
                ]
            )
            ->add(
                'phoneNumber',
                TextType::class,
                [
                    'label' => 'Customer phoneNumber',
                    'required' => true,
                    'widget' => 'single_text'
                ]
            )
            ->add(
                'email',
                TextType::class,
                [
                    'label' => 'Customer email',
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
                    'label' => 'Customer address',
                    'required' => true,
                    'attr' => [
                        'minlength' => 15
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
            'data_class' => Customer::class,
        ]);
    }
}
