<?php


namespace App\Http\Form\Recipe;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RecipeType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => "Nom de votre recette",
                'attr' => [
                    'autocomplete' => 'off',
                    'placeholder' => 'Nom de votre recette',
                ]
            ])
            ->add('recipe', TextareaType::class, [
                'required' => true,
                'label' => "Recette",
                'attr' => [
                    'autocomplete' => 'off',
                    'placeholder' => 'Recette',
                    'rows' => '15'
                ]
            ])
        ;
    }
}