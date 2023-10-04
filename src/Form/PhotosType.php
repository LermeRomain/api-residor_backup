<?php

namespace App\Form;

use App\Entity\Photos;
use App\Entity\Logements;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PhotosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class, [
                'label' => 'Image de la recette',
                'label_attr' => [
                    'class' => 'form-label mt-4',
                ],
                'required' => false,
            ])
            ->add('idLogements', EntityType::class, [ // Utilisez EntityType
                'class' => Logements::class, // Spécifiez l'entité cible
                'choice_label' => function (Logements $logement) {
                    // Vous pouvez personnaliser le libellé ici, par exemple, en utilisant $logement->getNom()
                    return $logement->getTitre(); // Remplacez par la propriété appropriée de l'entité Logements
                },
                'label' => 'Choisir un logement',
                'placeholder' => 'Sélectionnez un logement',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photos::class,
        ]);
    }
}