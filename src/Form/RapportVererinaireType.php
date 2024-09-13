<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RapportVererinaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("AnimalName", TextType::class, [
                "label" => "Nom de l'animal: ",
                "required" => true,
                "attr" => [
                    'class' => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_]{3,50}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le nom doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (_)',
                    "placeholder"=>"Nom"
                ]
            ])
            ->add('rapport', TextType::class, [
                "label" => "rapport: ",
                "required" => true,
                "attr" => [
                    "class" => "form-textarea",
                    'pattern' => "^[a-zA-Z0-9_.,:-!?']{3,500}$", // HTML5 pattern attribute for client-side validation
                    'title' => "Le rapport doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants(_ . , : - ! ? ')",
                    "placeholder"=>"Mettre le rapport"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
