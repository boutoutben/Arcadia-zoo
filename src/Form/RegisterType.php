<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add("employer", RadioType::class,[
                'label'=>'employé(e)',
                'row_attr' => ['for' => "choice2"],
                "attr"=>[
                    "value"=> "employer"
                ]

            ])
            ->add("veterinaire",RadioType::class, [
                "label"=>"vetérinaire",
                'row_attr' => ['for' => "choice2"],
                "attr"=>[
                    "value"=> "veterinaire",
                ]
                
            ])
            ->add('username', EmailType::class,[
                "label"=>'username: ',
                "required"=>true,
                "attr" => [
                    "class" => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_.@]{3,100}$', // HTML5 pattern attribute for client-side validation
                    'title' => "L'username doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (. @ _ -)",
                    "placeholder"=>"user@gmail.com"
                ]
                
            ])
            ->add('password', PasswordType::class, [
                "label" =>"password: ",
                "required"=>true,
                "attr" => [
                    "class" => "form-champ",
                    "id"=>"password",
                    "pattern" => "^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$",
                    "title" => "Le mot de passe doit contenir au moins une miniscule, un majuscule, un caractère spécials et un chiffre",
                    "placeholder" => "mot de passe"
                ]
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
