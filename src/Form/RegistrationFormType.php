<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom',
            TextType::class,[
            'constraints'=> [
                new NotBlank([
                    'message' => 'Veuillez saisir votre prénom.',
                ]),
            ],
        ])
            ->add('nom',
            TextType::class,[
            'constraints'=> [
                new NotBlank([
                    'message' => 'Veuillez saisir votre nom.',
                ]),
            ],
        ])

            ->add('email',
                TextType::class,[
                'constraints'=> [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre adresse email.',
                    ]),
                ],
            ])


            ->add('agreeTerms', CheckboxType::class, [
                'label'=>'Accepter les conditions',
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'label'=>'Mot de passe',
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir un mot de passe.',
                    ]),
                    new Length([
                        'min' => 12,
                        'minMessage' => 'Votre mot de passe doit comporter au moins 12 caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/\d/',
                        'message' => 'Votre mot de passe doit contenir au moins un chiffre.',
                    ]),
                    new Regex([
                        'pattern' => '/[A-Z]/',
                        'message' => 'Votre mot de passe devrait contenir au moins une lettre majuscule.',
                    ]),
                    new Regex([
                        'pattern' => '/[a-z]/',
                        'message' => 'Votre mot de passe devrait contenir au moins une lettre minuscule.',
                    ]),
                    new Regex([
                        'pattern' => '/[\W]/',
                        'message' => 'Votre mot de passe devrait contenir au moins un caractère spécial.',
                    ]),
                ],
            ])
            ->add('confirmPassword', PasswordType::class, [
                'mapped'=> false,
                'attr'=> [
                    'autocomplete'=>'new-password',
                    'class' =>'password-field'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
