<?php

namespace App\Form;

use App\Entity\AllHabitats;

use PHPUnit\TextUI\XmlConfiguration\CodeCoverage\Report\Text;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Test\TypeTestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifAllHabitatsCreateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class,[
                'label'=>"name: ",
                "required"=> true,
                'attr' => [
                    'class' => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_]{3,150}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'Le nom doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (_)',
                    "placeholder"=>"nom"
                    ]])
            ->add('description',TextType::class,[
                'label'=>"description: ",
                "required"=>true,
                'attr' => [
                    'class' => "form-champ",
                    'pattern' => '^[a-zA-Z0-9_.,:!?-]{3,150}$', // HTML5 pattern attribute for client-side validation
                    'title' => 'La description doit être composé uniquement de chaine de charactère, de chiffres et des charactère suivants (_ . , : ! - ?)',
                    "placeholder"=>"mettez la description"
                    ]])
            ->add("image",FileType::class, [
                'label'=> "image: ",
                "required"=> true,
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
