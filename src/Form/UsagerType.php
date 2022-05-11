<?php

namespace App\Form;

use App\Entity\Usager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;


class UsagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        
        ->add('genre', ChoiceType::class, [
            'choices'  => [
                'Homme' => 'Homme',
                'Femme' => 'Femme',
            ],
            'placeholder' => 'Choisir un sexe',
        ])
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('email')
            ->add('categorie', ChoiceType::class, [

                'choices'  => [
                    'Salarié' => 'Salarie',
                    'Retraité' => 'Retraité',
                    'demandeur d\'emploi' => 'demandeur d\'emploi',
                    'Collègue' => 'Collègue',
                    'Etudiant' => 'Etudiant',
                    'Scolaire' => 'Scolaire',
                    'Association' => 'Association',
                    'Centre de loisirs' => 'Centre de loisirs',
                    'Antennes de quartier' => 'Antennes de quartier',

                ],
            ])
            ->add('niveau', ChoiceType::class, [

                'choices'  => [
                    'Débutant' => 'Debutant',
                    'Intermidiare' => 'Intermidiare',
                    'Avanvé' => 'Avance',
                ],
            ])

            ->add('loisir')
            ->add('adresse')
            ->add('ville')
            ->add('cp')
            ->add('quartiers')
            ->add('partenaires')
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'les mots de passe ne sont pas identiques.',
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options'  => ['label' => 'Mot de passe'],
                'second_options' => ['label' => 'Confirmation Mot de passe'],
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Entrez un mot de passe svp',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères ',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usager::class,
        ]);
    }
}
