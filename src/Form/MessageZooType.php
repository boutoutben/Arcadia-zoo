<?php

namespace App\Form;

use App\Entity\MessageZoo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MessageZooType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('emailUser', EmailType::class,[
                'attr' => [
                    'class' => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_.@-]{3,100}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le pseudo doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (. @ _ -)',
                    "placeholder"=>"user@gmail.com"
                ],
                "label"=> "Votre email: ",
                "required" => true
            ])
            ->add('titleMessage',TextType::class,[
                'attr' => [
                    'class' => "form-champ",
                    'pattern' => "^[a-zA-Z0-9_']{3,20}$", // HTML5 pattern attribute for client-side validation
                    'title' => 'Le pseudo doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants( _ )',
                    "placeholder"=>"titre du message"
                ],
                "label"=>"titre: ",
                "required" => true
            ])
            ->add('message', TextType::class, [
                'attr' => [
                    'class' => "form-textarea",
                    'pattern' => '^[a-zA-Z0-9_.,:!?]{3,20}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le message doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants ( _ . , : ! ?)',
                    "placeholder"=>"Mettez votre message"
                ],
                "label"=>"message: ",
                "required"=>true
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
