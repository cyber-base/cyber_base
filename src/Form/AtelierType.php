<?php

namespace App\Form;

use App\Entity\Atelier;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;

class AtelierType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libelle', ChoiceType::class, [

                'choices'  => [
                    '3D Création' => '3D Création',
                    'Access' => 'Access',
                    'Achat / vente' => 'Achat vente',
                    'Album photo' => 'Album photo',
                    'Arnaques web' => 'Arnaques web',
                    'Blog' => 'Blog',
                    'Clavier' => 'Clavier',
                    'Clé USB' => 'Clé usb',
                    'CMS' => 'Cms',
                    'Conférence' => 'Conférence',
                    'Création de site web' => 'Création de site web',
                    'Dossier' => 'Dossier',
                    'Administration' => 'Administration',
                    'Email débutant' => 'Email Debutant',
                    'Email expert' => 'Email Expert',
                    'Emploi' => 'Emploi',
                    'Excel débutant' => 'Excel Debutant',
                    'Excel expert' => 'Excel Expert',
                    'Graphisme' => 'Graphisme',
                    'Graver' => 'Graver',
                    'Install logiciels' => 'Install Logiciels',
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
                    'Nettoyage Sécurite' => 'Nettoyage Sécurite',
                    'Ordi de A à Z' => 'Ordi de A à Z',
                    'PAO' => 'Pao',
                    'PDF' => 'Pdf',
                    'Photo débutant' => 'Photo débutant',
                    'Photo expert' => 'Photo expert',
                    'Photoshop' => 'Photoshop',
                    'PIM' => 'Pim',
                    'Power Point' => 'PowerPoint',
                    'Programmation' => 'Programmation',
                    'Publisher' => 'Publisher',
                    'Retouche photo' => 'Retouche photo',
                    'Scanner' => 'Scanner',
                    'Souris' => 'Souris',
                    'Tablette / Smartphone' => 'Tablette Smartphone',
                    'Trucage photo' => 'Trucage photo',
                    'Windows' => 'Windows',
                    'Word expert' => 'Word expert',


                ],
                'placeholder' => 'Choisir le thème de l\'atelier',
            ])
            ->add('date', DateType::class, [
                // renders it as a single text box
                'widget' => 'single_text',
                'data' => new \DateTime("now")
            ])
            ->add('start', DateTimeType::class,[
                'date_widget' => 'single_text',
            ])
            ->add('end', DateTimeType::class,[
                'date_widget' => 'single_text',
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
                    'placeholder' => 'Choisir une horaire',
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
                'placeholder' => 'Choisir une horaire',
            ],
            )
            ->add('statut', ChoiceType::class, [

                'choices'  => [
                    'Annulé' => 'Annulé',
                    'En attente' => 'En attente',
                    'Confirmé' => 'Confirmé',
                ],
                'placeholder' => 'Choisir un statut',
            ])
            
            ->add('animateurs')
            ->add('nbrPlaces', IntegerType::class, [
                'required' => true,
                    'attr' => [
                        'min' => 1,
                        'placeholder' => 'Veuillez saisir le Nombre de places',

                    ],
   
            ])
            ->add('backgroundColor', ColorType::class)

            ->add('borderColor', ColorType::class)
            
            ->add('textColor', ColorType::class)

            ->add('image', FileType::class, [
                'label' => 'Sélectionner un fichier',
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
