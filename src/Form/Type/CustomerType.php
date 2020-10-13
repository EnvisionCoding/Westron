<?php

namespace App\Form\Type;

use App\Entity\CustomerList;
use App\Entity\CustomerNotes;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CustomerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class, ['required' => true])
            ->add('last_name', TextType::class, ['required' => true])
            ->add('notes', TextareaType::class, ['required' => true, 'mapped' => false])
            ->add('save', SubmitType::class, ['label' => 'Create Customer'])

        ;
    }


    public function newCustomer(){
        $customerList = new CustomerList();
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CustomerList::class,
        ]);
    }
}