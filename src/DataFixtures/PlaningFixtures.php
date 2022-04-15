<?php

namespace App\DataFixtures;


use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Planning;
use App\Entity\Usager;
use App\Entity\Poste;
use App\Entity\Atelier;
use App\Entity\Animateur;
use App\Entity\Quartier;
use App\Entity\Partenaire;



class PlaningFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 7; $i++) {
            $Faker = Factory::create("fr_FR");

            $quartier = new Quartier();
            $quartier->setNomQuartier($Faker->streetName());
            $quartier->setNomQuartier($Faker->streetName());

            $partenaire = new Partenaire();
            $partenaire->setNomEtablissement($Faker->streetName())
                ->setTypeEtablissement($Faker->streetName());

            $usager = new Usager();
            $usager->setNom($Faker->firstName())
                ->setPrenom($Faker->lastName());
            $usager->setEmail($Faker->email())
                ->setTel($Faker->phoneNumber());
            $usager->setAdresse($Faker->streetAddress())
                ->setVille($Faker->streetName())
                ->setCp($Faker->postcode());
            $usager->setPassword($Faker->md5())
                ->setRoles(["ROLE_ANIMATEUR"])
                ->setCategorie($Faker->title())
                ->setNiveau($Faker->century())
                ->setLoisir($Faker->company())
                ->setQuartiers($quartier)
                ->setPartenaires($partenaire);

            $animateur = new Animateur();

            $animateur->setNom($Faker->firstName());
            $animateur->setPrenom($Faker->lastName());
            $animateur->setEmail($Faker->email());
            $animateur->setTel($Faker->phoneNumber());
            $animateur->setPassword($Faker->md5());
            $animateur->setRoles(["ROLE_ANIMATEUR"]);

            $atelier = new Atelier();

            $atelier->setLibelle($Faker->title());
            $atelier->setDate($Faker->dateTime());
            $atelier->setHeureDebut($Faker->dateTime());
            $atelier->setHeureFin($Faker->dateTime());
            $atelier->setStatut('en attente');
            $atelier->setAnimateurs($animateur);

            $poste = new Poste();
            $poste->setLibelle($Faker->name())
                ->setTypePoste($Faker->title());
            $manager->persist($partenaire);
            

            $planning = new Planning();
            $planning->setDate($Faker->dateTime());
            $planning->setUsagers($usager);
            $planning->setPostes($poste);
            $planning->setAteliers($atelier);


            $manager->persist($quartier);
            $manager->persist($partenaire);
            $manager->persist($usager);
            $manager->persist($animateur);
            $manager->persist($atelier);
            $manager->persist($poste);
            $manager->persist($planning);
            
            
            
           
        }

        $manager->flush();
    }
}
