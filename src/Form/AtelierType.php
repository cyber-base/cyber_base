<?php

namespace App\Form;

use App\Entity\Atelier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle')
            ->add('date', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('heureDebut')
            ->add('heureFin')
            ->add('statut')
            ->add('animateurs')
            ->add('photo', FileType::class, [
                'label' => 'Sélectionner fichier',

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                // 'constraints' => [
                //     new File([
                //         'maxSize' => '4024k',
                //         'mimeTypes' => [
                //             'application/jpg',
                //             'application/png',
                //         ],
                //         'mimeTypesMessage' => 'Please upload a valid  document',
                //     ])
                // ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}
