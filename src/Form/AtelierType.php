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
            ->add(
                'heureDebut',
                ChoiceType::class,
                [
                    'choices'  => [
                        '9H' => '10H',
                        '10H' => '11H',
                        '11H' => '12H',
                        '12H' => '13H',
                        '13H' => '14H',
                        '14H' => '15H',
                        '15H' => '16H',
                        '16H' => '17H',
                        '17H' => '18H',
                        '18H' => '19H',
                        

                    ],
                ],
            )
            ->add('heureFin', ChoiceType::class,
            [
                'choices'  => [
                    
                    '9H' => '10H',
                    '10H' => '11H',
                    '11H' => '12H',
                    '12H' => '13H',
                    '13H' => '14H',
                    '14H' => '15H',
                    '15H' => '16H',
                    '16H' => '17H',
                    '17H' => '18H',
                    '18H' => '19H',

                ],
            ],
            )
            ->add('statut', ChoiceType::class, [

                'choices'  => [
                    'Annulé' => 'Annulé',
                    'En attente' => 'En attente',
                    'Confirmé' => 'Confirmé',
                ],
            ])
            
            ->add('animateurs')
            ->add('image', FileType::class, [
                'label' => 'Sélectionner fichier',
                'mapped' => false,
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Atelier::class,
        ]);
    }
}
