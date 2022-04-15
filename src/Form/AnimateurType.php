<?php

namespace App\Form;

use App\Entity\Animateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;



class AnimateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('email')
            ->add('password')
            ->add('roles', ChoiceType::class, [
                'choices' =>[
                    'Super Animateur'=>'ROLE_SUPER_ANIMATEUR',
                    'Animateur'=>'ROLE_ANIMATEUR'
                ],

                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a role',
                    ])],

                'expanded' => true,
                'multiple' => true,
                'label' => 'Roles'
                ]);
        }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animateur::class,
        ]);
    }
}
