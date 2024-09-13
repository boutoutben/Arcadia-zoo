<?php

namespace App\Form;

use App\Entity\AllHabitats;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifAllHabitatsUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('nameToChange', TypeTextType::class,[
            'label'=>"name de l'habitat à changer: ",
            "required" => true,
            'attr' => [
                'class' => "form-champ",
                'pattern' => '^[a-zA-Z0-9_]{3,150}$', // HTML5 pattern attribute for client-side validation
                'title' => "Le nom doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ )",
                "placeholder" => "Nom à changer"
                ]])
            ->add('name', TypeTextType::class,[
                'label'=>"name: ",
                "required"=> false,
                'attr' => [
                    'class' => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_]{3,150}$', // HTML5 pattern attribute for client-side validation
                    'title' => "Le nom doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ )",
                    "placeholder" => "Nouveau nom"
                    ]])
            ->add('description',TextareaType::class,[
                'label'=>"description: ",
                "required"=>false,
                'attr' => [
                    'class' => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_.,!:?-]{3,300}$', // HTML5 pattern attribute for client-side validation
                    'title' => "La description doit être composé uniquement de chaine de charactère, de chiffres et de certaines caractère spécial ( _ . , : ! - ? )",
                    "placeholder" => "mettez la description"
                    ]])
            ->add("image",FileType::class, [
                'label'=> "image: ",
                "required"=> false,
                "attr"=> [
                    "class"=> "imageAllHabitats"
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
