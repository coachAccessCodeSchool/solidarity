<?php


namespace App\Http\Form\Recipe;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\String\Slugger\SluggerInterface;

class RecipeType extends AbstractType
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }


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
            ->add('imageFile', FileType::class, [
                'required' => false,
                'label' => 'Image'
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $recipe = $event->getData();
                if (null !== $recipeTitle = $recipe->getName()) {
                    $recipe->setSlug($this->slugger->slug($recipeTitle)->lower());
                }
            })
        ;
    }
}