<?php

namespace App\Form;

use App\Entity\Avis;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\DataTransformerInterface;


class CreateAvisType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('pseudo', TextType::class, [
                'label' => "pseudo: ",
                "required" => false,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_]{3,20}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le pseudo doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (. , : ! ?)' ,
                    "placeholder"=>"pseudo"
                ],
            ])
            ->add('avis', TextType::class, [
                "label" => "avis: ",
                "required" => true,
                "attr" => [
                    "class" => "form-textarea",
                    'pattern' => "^[a-zA-Z0-9 ,.:!']{3,100}$",
                    "title"=> "L'avis peut être composé que de chaine de charactère, de nombre et des charactères suivants (. , : ! ?)",
                    "placeholder" => 'avis'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Avis::class,
        ]);
    }
}
