<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentaireHabitatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('habitatName', TextType::class, [
                "label" => "nom de l'habitat: ",
                "required" => true,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_]{3,150}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le nom doit être composé uniquement de chaine de charactère et de chiffres',
                    "placeholder"=>"nom de l'habitat"
                ]
            ])
            ->add("commentaire", TextType::class, [
                "label" => "commentaire: ",
                "required" => true,
                "attr" => [
                    "class" => "form-textarea",
                    'pattern' => '^[a-zA-Z0-9_.,:!?]{3,500}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le pseudo doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants',
                    "placeholder"=>"Mettez votre commentaire"
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
