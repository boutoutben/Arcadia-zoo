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

class ModifAnimalCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'name: ',
                'required' => true,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_]{3,150}$', // HTML5 pattern attribute for client-side validation
                    'title' => "Le nom doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ )",
                    "placeholder" => "Nom"
                ]
            ])
            ->add('etat', TextType::class, [
                'label' => 'etat: ',
                "required" => true,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_.,:!?-]{3,250}$', // HTML5 pattern attribute for client-side validation
                'title' => "L'état doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ . , : ! ? -)",
                "placeholder" => "etat"
                ]
            ])

            ->add("race", TextType::class, [
                "label" => "race: ",
                "required" => true,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_-]{3,150}$', // HTML5 pattern attribute for client-side validation
                    'title' => "La race doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ -)",
                    "placeholder" => "race de l'animal"
                ]
            ])

            ->add("img", FileType::class, [
                "required" => true,
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
