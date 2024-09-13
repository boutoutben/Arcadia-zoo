<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('days', TextType::class, [
                "label" => "jour: ",
                "required" => true, 
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z]{3,20}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le nom doit être composé uniquement de chaine de charactère',
                    "placeholder"=>"lundi"
                ]
            ])
            ->add("schedule", TextType::class, [
                "label" => "Horraires de la journée: ",
                "required" => true,
                "attr" => [
                    "class" => "form-champ",
                    "placeholder"=> "19h30-20h"
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
