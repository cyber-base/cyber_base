<?php

namespace App\Form;

use App\Entity\Usager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class UsagerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('prenom')
            ->add('tel')
            ->add('email')
            ->add('password')
            ->add('categorie')
            ->add('niveau')
            ->add('loisir')
            ->add('adresse')
            ->add('ville')
            ->add('cp')
            ->add('quartiers')
            ->add('partenaires')
            // ->add('roles', ChoiceType::class
            // )
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Usager::class,
        ]);
    }
}
