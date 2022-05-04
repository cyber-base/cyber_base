<?php

namespace App\Form;

use App\Entity\Atelier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('libelle', ChoiceType::class, [

            'choices'  => [
                '3D Creation' => '3dCreation',
                'Access' => 'Access',
                'Achat / vente' => 'AchatVente',
                'Album photo' => 'AlbumPhoto',
                'Arnaques web' => 'ArnaquesWeb',
                'Blog' => 'Blog',
                'Clavier' => 'Clavier',
                'Clé USB' => 'CleUsb',
                'CMS' => 'Cms',
                'Conférence' => 'Conference',
                'Création de Site Web' => 'CreationDeSiteWeb',
                'Dossier' => 'Dossier',
                'Administration' => 'Administration',
                'Email débutant' => 'EmailDebutant',
                'Email expert' => 'EmailExpert',
                'Emploi' => 'Emploi',
                'Excel débutant' => 'ExcelDebutant',
                'Excel expert' => 'ExcelExpert',
                'Graphisme' => 'Graphisme',
                'Graver' => 'Graver',
                'Install Logiciels' => 'InstallLogiciels',
                'Internet débutant' => 'InternetDebutant',
                'Internet expert' => 'InternetExpert',
                'Jeux' => 'Jeux',
                'Linux' => 'Linux',
                'Logiciels gratuits' => 'LogicielsGratuits',
                'Mac OS X' => 'MacOSX',
                'MAO' => 'Mao',
                'Montage artistique' => 'MontageArtistique',
                'Montage PC' => 'MontagePc',
                'Montage video' => 'MontageVideo',
                'Nettoyage sécurite' => 'NettoyageSecurite',
                'Ordi de A à Z' => 'OrdiDeAaZ',
                'PAO' => 'Pao',
                'PDF' => 'Pdf',
                'Photo débutant' => 'PhotoDebutant',
                'Photo expert' => 'PhotoExpert',
                'Photoshop' => 'Photoshop',
                'PIM' => 'Pim',
                'Power Point' => 'PowerPoint',
                'Programmation' => 'Programmation',
                'Publisher' => 'Publisher',
                'Retouche photo' => 'RetouchePhoto',
                'Scanner' => 'Scanner',
                'Souris' => 'Souris',
                'Tablette / Smartphone' => 'TabletteSmartphone',
                'Trucage photo' => 'TrucagePhoto',
                'Windows' => 'Windows',
                'Word expert' => 'WordExpert',
                

            ],
        ])
            ->add('date', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
            ])
            ->add('heureDebut')
            ->add('heureFin')
            ->add('statut', ChoiceType::class, [
                
                'choices'  => [
                    'En attente' => 'En attent',
                    'Confirmé' => 'Confirmé',
                ],
            ])
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
