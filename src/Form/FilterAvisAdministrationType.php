<?php

namespace App\Form;

use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilterAvisAdministrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameAnimal', TextType::class, [
                "label"=> "nom de l'animal: ",
                "required" => false,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_]{3,50}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le nom doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (_)',
                    "placeholder"=>"Nom"
                ]
            ])
            ->add("date", TextType::class, [
                "label" => "date: ",
                "required" => false,
                "attr" => [
                    "class" => "form-champ",
                    "pattern" => "^[0-9]{4}[-]{1}[0-9]{2}[-]{1}[0-9]{2}$",
                    "title"=>"La date doit être sous le format années-mois-jour",
                    "placeholder"=> "année-mois-jour",
                ],
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
