<?php

namespace App\Form;

use App\Entity\Poste;
use App\Entity\Usager;
use App\Entity\Atelier;
use App\Entity\Planning;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;





class PlanningType extends AbstractType
{
    private $selected;
    private $postes;
    private $usagers;

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $this->selected = $options['selected'];
        $this->postes = $options['postes'];
        $this->usagers = $options['usagers'];

        $builder
           
            ->add('usagers', EntityType::class, [
                'class' => Usager::class,
                'placeholder' => 'Choisir un Usager',
                'choice_label' => function ($usager) {
                    return $usager->getNom() . " " . $usager->getPrenom();
                },
                'choice_attr' => function ($usager, $key, $value,) {
                    // adds a class like attending_yes, attending_no, etc
                    return [
                        'disabled' => !in_array($usager, $this->usagers),
                    ];
                },

            ])
            ->add('postes', EntityType::class, [
                'class' => Poste::class,
                'placeholder' => 'Choisir un Poste',
                'choice_label' => function ($poste) {
                    return $poste->getLibelle();
                },

                'choice_attr' => function ($poste, $key, $value,) {
                    // adds a class like attending_yes, attending_no, etc
                    return [
                        'disabled' => !in_array($poste, $this->postes),
                    ];
                },
            ])
            ->add('ateliers', EntityType::class, [
                'class' => Atelier::class,
                // 'attr' => ['disabled' => true],
                'placeholder' => 'Choisir un Usager',
                // 'options' => $options['selected'],
                'choice_label' => function ($atelier) {
                    return $atelier->getLibelle() . " - " . $atelier->getDate()->format('d/m/Y') . " De " . $atelier->getHeureDebut() . " À " . $atelier->getHeureFin();
                },

                'choice_attr' => function ($atelier, $key, $value,) {
                    // adds a class like attending_yes, attending_no, etc
                    return [
                        'selected' => $atelier->getId() == $this->selected,
                        'disabled' => $atelier->getId() != $this->selected
                    ];
                },

            ]);

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
            'selected' => null,
            'postes' => null,
            'usagers' => null,
        ]);
    }
}
