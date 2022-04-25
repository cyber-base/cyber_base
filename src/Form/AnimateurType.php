<?php

namespace App\Form;

use App\Entity\Animateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class AnimateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // ->add('nom',null, [
        //     'empty_data' => '',
        // ])
            ->add('nom',null,[
                'required'   => false,
                'empty_data' => '',
            ])
            ->add('prenom',null,[
                'required'   => false,
                'empty_data' => '',
            ])
            ->add('tel',null,[
                'required'   => false,
                'empty_data' => '',
            ])
            ->add('email',EmailType::class,[
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci d\'entrer un e-mail',
                    ]),
                ],
                'empty_data' => '',
                'required' => true,
                'attr' => ['class' =>'form-control'],
            ])
            
            // ->add('password')
            ->add('plainPassword', RepeatedType::class,[
                'type' => PasswordType::class,
                'first_options'  => array('label' => 'Mot de passe*'),
                'second_options' => array('label' => 'Confirmation mot de passe'),
                'empty_data' => '',
                'required' => true,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                // 'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
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
