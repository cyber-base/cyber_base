<?php

namespace App\Form;

use App\Entity\Poste;
use App\Entity\Usager;
use App\Entity\Atelier;
use App\Entity\Planning;
use App\Repository\PlanningRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;




class PlanningType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $builder
            // ->add('date')
            //     ->add('usagers', ChoiceType::class, [
            // 'placeholder' => 'Select a value'

            //     ])
            ->add('usagers', EntityType::class, [
                'class' => Usager::class,
                'placeholder' => 'Choisir un Usager',
                'choice_label' => function ($usager) {
                    return $usager->getNom() . " " . $usager->getPrenom();
                }

            ])
            ->add('postes', EntityType::class, [
                'class' => Poste::class,
                'placeholder' => 'Choisir un Poste',
                'choice_label' => function ($poste) {
                    return $poste->getLibelle();
                }
            ])
            ->add('ateliers')

            
            //  ->add('ateliers', EntityType::class, [
            //         'class' => Atelier::class,
            //         'query_builder' => function (EntityRepository $er) {
            //             return $er->createQueryBuilder('atelier')
            //             ->select('atelier.id')
            //             ->orderBy('atelier.id', 'DESC');

            //         }
            //     ])


            // ->add('ateliers',TextType::class,[
            //     'attr' => ['readonly' => true],
            // ]);
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Planning::class,
            'ateliers' => null,
        ]);
    }
}
