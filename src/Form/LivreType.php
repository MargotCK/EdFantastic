<?php

namespace App\Form;

use App\Entity\Age;
use App\Entity\Livre;
use App\Entity\Serie;
use App\Entity\Theme;
use App\Entity\Auteur;
use App\Entity\Illustrateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'required'=> false,
                'attr'=>[
                'class'=> ' border border-primary'
                ],
                'constraints' =>[
                    new NotBlank([
                    ])
                ]
            ])

            ->add('ean', TextType::class,  [
                'required'=> false,
                'attr'=>[
                    'class'=> ' border border-primary'
                ],
                'constraints' =>[
                    new NotBlank([
                    ]),
                    new Length([
                        'min'=> 13,
                        'max'=> 13,
                        'minMessage'=>"Veuillez saisir les 13 chifrres de l'EAN.",
                        'maxMessage'=>"Veuillez saisir les 13 chifrres de l'EAN."
                    ])
                ]
            ])
            ->add('prix', MoneyType::class, [
                'label'=> 'Prix du livre',
                'required'=> false,
                'attr'=>[
                    'placeholder'=> 'saisir le prix du produit',
                    'class'=> ' border border-primary'
                ],
                'constraints' =>[
                    new NotBlank([
                    ]),
                    new PositiveOrZero([
                        'message'=>"Le prix ne peut pas être négatif."
                    ])
                ]
            ])
            

            ->add('datePublication', null, [
                'required'=> false,
                'widget' => 'single_text'
            ])

            ->add('format', TextType::class, [
                'required'=> false,
                'attr'=>[
                    'placeholder'=> 'saisir le format en cm',
                    'class'=> ' border border-primary'
                ]
            ])
            ->add('nbPage', IntegerType::class, [
                'required'=> false,
                'attr'=>[
                    'class'=> ' border border-primary'
                ],
                'constraints'=> [
                    new PositiveOrZero([])
                ]
            ])

            ->add('serie', EntityType::class,[
                'required'=> false,
                'label'=>'collection',
                'class'=> Serie::class,
                'choice_label'=> 'nom',       
            ])

            ->add('age', EntityType::class, [
                'required'=> false,
                'class'=> Age::class,
                'choice_label'=> 'categorie',
                'multiple' => false, 
                'expanded' => false, 
            ])

            ->add('theme', EntityType::class,[
                'required'=> false,
                'class'=> Theme::class,
                'choice_label'=> 'nom',
                'multiple' => true,
                'expanded'=> true,

                ])

            ->add('auteur', EntityType::class,[
                'required'=> false,
                'class'=> Auteur::class,
                'choice_label'=> 'prenom',
                'multiple' => true,
                'expanded'=> true,

                ])

            ->add('illustrateur', EntityType::class,[
                    'required'=> false,
                    'class'=> Illustrateur::class,
                    'choice_label'=> 'prenom',
                    'multiple' => false,
                    'expanded'=> false,
    
                    ])   

            ->add('quantiteStock', IntegerType ::class, [
                'label'=>'Quantité de livre en stock',
                'required'=> false,
                'attr'=>[
                    'class'=> ' border border-primary'
                ],
                'constraints'=> [
                    new PositiveOrZero([])
                ]
            ])
            ->add('resume',TextareaType::class, [
                'label'=> 'Résumé du livre',
                'required'=> false,
                'attr'=>[
                    'class'=> ' border border-primary'
                ]
            ])

            ->add('couv1', FileType::class, [
                'label'=>'1ère de couverture',
                'required'=>false,
                'mapped'=> false,
                'attr'=>[
                    'class'=> ' border border-primary'
                ],

                'constraints'=> [
                    new Image([
                        'minWidth' => 200,
                        'maxWidth' => 1500,
                        'minHeight' => 200,
                        'maxHeight' => 1500,
                        'allowLandscape' => true,
                        'allowPortrait' => true,
                    ])
                ]
            ])

            ->add('couv4', FileType::class, [
                'label'=>'4ème de couverture',
                'required'=>false,
                'attr'=>[
                    'class'=> ' border border-primary'
                ],
                'constraints'=> [
                    new Image([
                        'minWidth' => 200,
                        'maxWidth' => 1000,
                        'minHeight' => 200,
                        'maxHeight' => 1000,
                        'allowLandscape' => true,
                        'allowPortrait' => true,
                    ])
                ]
            ])


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
