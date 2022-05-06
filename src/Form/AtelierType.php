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
                    '3D Création' => '3D Création',
                    'Access' => 'Access',
                    'Achat / vente' => 'Achat Vente',
                    'Album photo' => 'Album Photo',
                    'Arnaques web' => 'Arnaques Web',
                    'Blog' => 'Blog',
                    'Clavier' => 'Clavier',
                    'Clé USB' => 'CleUsb',
                    'CMS' => 'Cms',
                    'Conférence' => 'Conference',
                    'Création de Site Web' => 'Creation De Site Web',
                    'Dossier' => 'Dossier',
                    'Administration' => 'Administration',
                    'Email débutant' => 'Email Debutant',
                    'Email expert' => 'Email Expert',
                    'Emploi' => 'Emploi',
                    'Excel débutant' => 'Excel Debutant',
                    'Excel expert' => 'Excel Expert',
                    'Graphisme' => 'Graphisme',
                    'Graver' => 'Graver',
                    'Install Logiciels' => 'Install Logiciels',
                    'Internet débutant' => 'Internet Debutant',
                    'Internet expert' => 'Internet Expert',
                    'Jeux' => 'Jeux',
                    'Linux' => 'Linux',
                    'Logiciels gratuits' => 'Logiciels Gratuits',
                    'Mac OS X' => 'MacOSX',
                    'MAO' => 'Mao',
                    'Montage artistique' => 'Montage Artistique',
                    'Montage PC' => 'Montage Pc',
                    'Montage video' => 'Montage Video',
                    'Nettoyage sécurite' => 'Nettoyage Securite',
                    'Ordi de A à Z' => 'OrdiDeAaZ',
                    'PAO' => 'Pao',
                    'PDF' => 'Pdf',
                    'Photo débutant' => 'Photo Debutant',
                    'Photo expert' => 'Photo Expert',
                    'Photoshop' => 'Photoshop',
                    'PIM' => 'Pim',
                    'Power Point' => 'PowerPoint',
                    'Programmation' => 'Programmation',
                    'Publisher' => 'Publisher',
                    'Retouche photo' => 'Retouche Photo',
                    'Scanner' => 'Scanner',
                    'Souris' => 'Souris',
                    'Tablette / Smartphone' => 'Tablette Smartphone',
                    'Trucage photo' => 'Trucage Photo',
                    'Windows' => 'Windows',
                    'Word expert' => 'Word Expert',


                ],
            ])
            ->add('date', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
                'data' => new \DateTime("now")
            ])
            ->add(
                'heureDebut',
                ChoiceType::class,
                [
                    'choices'  => [
                        '9H'  => '9H',
                        '10H' => '10H',
                        '11H' => '11H',
                        '12H' => '12H',
                        '13H' => '13H',
                        '14H' => '14H',
                        '15H' => '15H',
                        '16H' => '16H',
                        '17H' => '17H',
                        '18H' => '18H',
                    ],
                ],
            )
            ->add('heureFin', ChoiceType::class,
            [
                'choices'  => [
                    
                    '10H' => '10H',
                    '11H' => '11H',
                    '12H' => '12H',
                    '13H' => '13H',
                    '14H' => '14H',
                    '15H' => '15H',
                    '16H' => '16H',
                    '17H' => '17H',
                    '18H' => '18H',
                    '19H' => '19H',

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
