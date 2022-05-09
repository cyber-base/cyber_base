<?php

namespace App\Form;

use App\Entity\Animateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;




class AnimateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('genre', ChoiceType::class, [
            'choices'  => [
                'Homme' => 'Homme',
                'Femme' => 'Femme',
            ],
            'placeholder' => 'Choisir le Sexe',
        ])
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('email')
            ->add('plainPassword', RepeatedType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'type' => PasswordType::class,
                'invalid_message' => 'les mots de passe ne sont pas indentiques.',
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
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
            ->add('roles', ChoiceType::class, [
                'choices' =>[
                    'Super Animateur'=>'ROLE_SUPER_ANIMATEUR',
                    'Animateur'=>'ROLE_ANIMATEUR'
                ],

                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a role',
                    ])],

                // 'expanded' => true,
                'multiple' => true,
                'label' => 'Roles'
                ])
               ;
        }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animateur::class,
        ]);
    }
}
