<?php

namespace App\Http\Form\Auth;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RegisterType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'autocomplete' => 'off',
                    'placeholder' => 'Nom d\'utilisateur',
                    'class' => 'form-auth'
                ]
            ])

            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'invalid_message' => 'Les mot de passe ne correspondent pas',
                'required' => true,
                'first_options' => [
                    'label' => false,
                    'attr' => ['autocomplete' => 'off', 'placeholder' => "Mot de passe", 'class' => 'form-auth']
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => ['autocomplete' => 'off', 'placeholder' => "Confirmer le mot de passe", 'class' => 'form-auth']
                ]
            ])

        ;
    }
}