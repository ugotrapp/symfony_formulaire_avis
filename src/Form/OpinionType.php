<?php

namespace App\Form;

use App\Entity\Opinion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class OpinionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'attr' => ['class' => 'form','placeholder' => 'Renseigner votre nom et prénom']
            ])
            ->add('email',EmailType::class, [
                'attr' => ['class' => 'form', 'placeholder' => 'Renseigner votre email']
            ])
            ->add('contenu', TextareaType::class, [
                'attr' => ['class' => 'form','placeholder' => 'Donner votre avis'],
            ])
            ->add('date_de_creation', DateType::class, [
                'widget' => 'single_text',
                'attr' => ['class' => 'form'],
            ])
            ->add('note', ChoiceType::class, [
                'choices'  => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5
            ],
                'expanded' => true,
                'attr' => ['class' => 'radio']])
            
            ->add('active');
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Opinion::class,
        ]);
    }
}
