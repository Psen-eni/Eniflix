<?php

namespace App\Form;

use App\Entity\Serie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File; // ✅ CORRECT import

class SerieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la série',
                'required' => false,
            ])
            ->add('overview', TextareaType::class)
            ->add('status', ChoiceType::class, [
                'choices' => [
                    'En cours' => 'Returning',
                    'Terminée' => 'Ended',
                    'Abandonée' => 'Canceled',
                ],
                'placeholder' => ' -- Choisissez un statut --',
            ])
            ->add('vote')
            ->add('popularity')
            ->add('genre')
            ->add('firstAirDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('lastAirDate', DateType::class, [
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('backdrop')
            ->add('poster_file', FileType::class, [
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'maxSizeMessage' => 'Votre fichier est trop lourd !',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Les formats acceptés sont jpeg, png, jpg',
                    ])
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Enregistrer',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Serie::class,
        ]);
    }
}
