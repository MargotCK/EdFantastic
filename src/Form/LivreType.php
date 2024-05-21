<?php

namespace App\Form;

use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

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
                'constraints' => [
                    new NotBlank([
                        'message'=> 'Veuillez saisir le titre du produit'
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
                        'minMessage'=>"Veuillez saisir les 13 chifrres de l'EAN .",
                        'maxMessage'=>"Veuillez saisir les 13 chifrres de l'EAN ."
                    ])
                ]
            ])
            ->add('prix', MoneyType::class, [
                'label'=> 'Prix du livre',
                'required'=> false,
                'attr'=>[
                    'placeholder'=> 'saisir le prix du produit',
                    'class'=> ' border border-primary'
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

            ->add('quantiteStock', IntegerType::class, [
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
                ]
                /**'constraints'=> [
                    new Image([
                        'minWidth' => 200,
                        'maxWidth' => 400,
                        'minHeight' => 200,
                        'maxHeight' => 400,
                        'allowLandscape' => false,
                        'allowPortrait' => false,
                    ])
                ]*/
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
                        'maxWidth' => 400,
                        'minHeight' => 200,
                        'maxHeight' => 400,
                        'allowLandscape' => false,
                        'allowPortrait' => false,
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
