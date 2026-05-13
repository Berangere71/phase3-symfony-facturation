<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileFormType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options
    ): void {

        $builder

            ->add('firstName', TextType::class, [
                'label' => 'Prénom',
                'required' => false
            ])

            ->add('lastName', TextType::class, [
                'label' => 'Nom',
                'required' => false
            ])

            ->add('email', EmailType::class, [
                'label' => 'Email'
            ])

            ->add('companyName', TextType::class, [
                'label' => 'Raison Sociale',
                'required' => false
            ])

            ->add('adress', TextType::class, [
                'label' => 'Adresse',
                'required' => false
            ])

            ->add('postalCode', TextType::class, [
                'label' => 'Code Postal',
                'required' => false
            ])

            ->add('town', TextType::class, [
                'label' => 'Ville',
                'required' => false
            ])

            ->add('siret', TextType::class, [
                'label' => 'Numéro SIRET',
                'required' => false
            ])

            ->add('siren', TextType::class, [
                'label' => 'Numéro SIREN',
                'required' => false
            ])

            ->add('iban', TextType::class, [
                'label' => 'IBAN',
                'required' => false
            ])

            ->add('phoneFixed', TextType::class, [
                'label' => 'Téléphone fixe',
                'required' => false
            ])

            ->add('phoneMobile', TextType::class, [
                'label' => 'Téléphone portable',
                'required' => false
            ])

            ->add('companyType', ChoiceType::class, [

                'label' => 'Type de structure',

                'choices' => [

                    'Auto-entrepreneur' => 'auto',
                    'Association' => 'association',
                    'EURL' => 'eurl',
                    'SARL' => 'sarl',
                    'SAS' => 'sas',
                    'SA' => 'sa',
                ],

                'placeholder' => '-- Choisissez --',
                'required' => false,
            ])

            ->add('cgv', TextareaType::class, [

                'label' => 'Conditions Générales de Vente',

                'required' => false,

                'attr' => [
                    'rows' => 20
                ]
            ]);
    }

    public function configureOptions(
        OptionsResolver $resolver
    ): void {

        $resolver->setDefaults([
            'data_class' => User::class
        ]);
    }
}