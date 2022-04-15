<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Usager;
use App\Entity\Partenaire;
use App\Entity\Quartier;
class UsagerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 7; $i++) {
            $Faker = Factory::create("fr_FR");
        
        $partenaire = new Partenaire();
        $partenaire->setNomEtablissement($Faker->company());
        $partenaire->setTypeEtablissement($Faker->company());
        $quartier = new Quartier();
        $quartier->setNomQuartier($Faker->streetAddress());

        $usager = new Usager();
            $usager->setNom($Faker->firstName())
                   ->setPrenom($Faker->lastName());
            $usager->setEmail($Faker->email())
                   ->setTel($Faker->phoneNumber());
            $usager->setPassword($Faker->md5())
                   ->setAdresse($Faker->streetAddress())
                   ->setVille($Faker->streetName())
                   ->setCp($Faker->postcode())
                   ->setRoles(["ROLE_ANIMATEUR"])
                   ->setCategorie($Faker->title())
                   ->setNiveau($Faker->century())
                   ->setLoisir($Faker->company())
                   ->setPartenaires($partenaire)
                   ->setQuartiers($quartier);
       
                   $manager->persist($partenaire);
                   $manager->persist($quartier);
                   $manager->persist($usager);

        $manager->flush();
    }
}
}