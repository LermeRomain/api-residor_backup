<?php

namespace App\Form;

use App\Entity\Logements;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PhotosType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image du logement',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'required' => false,
                'attr' => [
                    'class' => 'form-control', // Ajoutez la classe Bootstrap pour les champs de formulaire
                ],
            ])
            ->add('idLogements', EntityType::class, [
                'class' => Logements::class,
                'choice_label' => function (Logements $logement) {
                    return $logement->getTitre();
                },
                'label' => 'Choisir un logement',
                'placeholder' => 'Sélectionnez un logement',
                'attr' => [
                    'class' => 'form-control', // Ajoutez la classe Bootstrap pour les champs de formulaire
                ],
            ]);
    }
}