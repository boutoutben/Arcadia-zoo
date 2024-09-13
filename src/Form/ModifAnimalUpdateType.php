<?php

namespace App\Form;

use App\Entity\AllHabitats;
use App\Entity\Animal;
use App\Entity\Races;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifAnimalUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add("nameToChange", TextType::class, [
            "label" => "name de l'animal à changer: ",
            "required" => true, 
            "attr" => [
                "class" => "form-champ",
                'pattern' => '^[a-zA-Z0-9_]{3,150}$', // HTML5 pattern attribute for client-side validation
                'title' => "Le nom doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ )",
                "placeholder" => "Nom à changer"
            ]
        ])
        ->add('name', TextType::class, [
            'label' => 'name: ',
            'required' => false,
            "attr" => [
                "class" => "form-champ",
                'pattern' => '^[a-zA-Z0-9_]{3,150}$', // HTML5 pattern attribute for client-side validation
                'title' => "Le nom doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ )",
                "placeholder" => "Nouveau nom"
            ]
        ])
        ->add('etat', TextType::class, [
            'label' => 'etat',
            "required" => false,
            "attr" => [
                "class" => "form-champ",
                'pattern' => "^[a-zA-Z0-9_.,!:-?']{3,150}$", // HTML5 pattern attribute for client-side validation
                'title' => "L'état doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _  . , : ! ? - ')",
                "placeholder" => "Nouvelle état"
            ]
        ])

        ->add("raceToChange", TextType::class, [
            "label" => "nom de la race à modifier",
            "required" => false,
            "attr" => [
                "class" => "form-champ",
                'pattern' => '^[a-zA-Z0-9_-]{3,150}$', // HTML5 pattern attribute for client-side validation
                'title' => "La race doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _  -)",
                "placeholder" => "Race à changer"
            ]
        ])

        ->add("race", TextType::class, [
            "label" => "race",
            "required" => false,
            "attr" => [
                "class" => "form-champ",
                'pattern' => '^[a-zA-Z0-9_-]{3,150}$', // HTML5 pattern attribute for client-side validation
                'title' => "La race doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _  -)",
                "placeholder" => "Nouvelle race"
            ]
        ])

        ->add("img", FileType::class, [
            "required" => false
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
