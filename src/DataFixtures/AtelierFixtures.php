<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Atelier;
use App\Entity\Animateur;
class AtelierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 7 ; $i++) { 
            $Faker = Factory::create("fr_FR");
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

            $manager->persist($atelier);
            $manager->persist($animateur);
            
            
        }

        $manager->flush();
    }
}
