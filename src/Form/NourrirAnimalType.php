<?php

namespace App\Form;

use Doctrine\DBAL\Types\DateTimeType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType as TypeDateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class NourrirAnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', TypeDateTimeType::class, [
                'label' => "date: ",
                "required" => true,
                "attr" => [
                    "class" => "form-champ",
                ]
            ])
            ->add("nourriture", TextType::class,[
                "label" => "Nourriture données: ",
                "required" => true,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9]{3,50}$', // HTML5 pattern attribute for client-side validation
                    'title' => "Le nom de la nourrire doit être composé uniquement de chaine de charactère et de chiffres",
                    "placeholder" => "poisson"
                ]
            ])

            ->add("quantitee", IntegerType::class, [
                "label" => "Quantitées(g): ",
                "required" => true,
                "attr" => [
                    "class" => "form-champ",
                    "placeholder" => "100"
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
