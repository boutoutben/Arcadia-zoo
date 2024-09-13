<?php

namespace App\Form;

use App\Entity\Services;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifServicesCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label'=>"name: ",
            "required" => true,
            'attr' => [
                'class' => "form-champ",
                'pattern' => '^[a-zA-Z0-9_]{3,50}$', // HTML5 pattern attribute for client-side validation
                'title' => 'Le nom doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (_)',
                "placeholder"=>'nom'
            ]])
            ->add('description',TextType::class, [
                'label'=>"description: ",
                "required" => true,
                'attr' => [
                    'class' => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_.,:-!?]{3,50}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'La description doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (_ . , : - ! ?)',
                    'placeholder' => "description"
                ]])
            ->add('image', FileType::class, [
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
