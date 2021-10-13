<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Validator\Constraints\Length;

class OpinionSearchType extends AbstractType
{
    private $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            
            ->add('q', SearchType::class, [
                // Le champ n'est pas obligatoire
                'required' => false,
                // Masquage du label (le nom) du champ
                'label' => false,
                'attr' => [
                    // Sélection des classes CSS
                    'class' => 'form-control mr-sm-2',
                    // Affectation d'un placeholder 
                    'placeholder' => 'Search',
                ],
                // Contraintes de validation
                'constraints' => [
                    new Length([
                        // Longueur min
                        'min' => 3,
                        // Longueur max
                        'max' => 255,
                    ])
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Désactivation de la protection CSRF.
            // Elle n'est pas indispensable car c'est juste un formulaire de recherche.
            'csrf_protection' => false,
            'attr' => [
                // Sélection des classes CSS
                'class' => 'form-inline my-2 my-lg-0',
                // Attribut d'accessibilité
                'aria-label' => "Search",
            ],
        ]);
    }

    
}