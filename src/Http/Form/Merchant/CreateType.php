<?php


namespace App\Http\Form\Merchant;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class CreateType extends AbstractType
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
                'label' => "Nom de votre commerce",
                'attr' => [
                    'autocomplete' => 'off',
                    'placeholder' => 'Nom de votre commerce',
                ]
            ])

            ->add('information', TextareaType::class, [
                'required' => true,
                'label' => "Information sur votre commerce",
                'attr' => [
                    'autocomplete' => 'off',
                    'placeholder' => 'Information sur votre commerce',
                    'rows' => '11'
                ]
            ])

        ;
    }
}