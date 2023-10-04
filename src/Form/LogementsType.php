<?php

namespace App\Form;

use App\Entity\Logements;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LogementsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre', TextType::class, [
                'label' => 'Titre de la propriété',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('description', TextType::class, [
                'label' => 'Description courte',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('rentalready', IntegerType::class, [
                'label' => 'Id Rental Ready',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('prixmoyen', IntegerType::class, [
                'label' => 'Prix Moyen',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])->add('salledebains', IntegerType::class, [
                'label' => 'Nombre de salle de bain',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('rating', NumberType::class, [
                'label' => 'Note',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                    'step' => '0.1', // Définit le pas de l'input (permet les décimales)
                    'min' => '0',    // Note minimale
                    'max' => '5',   // Note maximale
                ],
            ])
            ->add('capacity', IntegerType::class, [
                'label' => 'Capacité accueil',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('chambres', IntegerType::class, [
                'label' => 'Nombre de chambre',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('douche', IntegerType::class, [
                'label' => 'Nombre de Salle de bain',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('superficie', IntegerType::class, [
                'label' => 'Superficie',
                'label_attr' => [
                    'class' => 'h3 mt-3',
                ],
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Logements::class,
        ]);
    }
}
