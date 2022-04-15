<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Animateur;
// use Doctrine\DBAL\Driver\IBMDB2\Exception\Factory as ExceptionFactory;
use Faker\Factory;

class AnimateurFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i < 7 ; $i++) { 
        $Faker = Factory::Create('fr_FR');
        $animateur = new Animateur();

        $animateur->setNom($Faker->firstName());
        $animateur->setPrenom($Faker->lastName());
        $animateur->setEmail($Faker->email());
        $animateur->setTel($Faker->phoneNumber());
        $animateur->setPassword($Faker->md5());
        $animateur->setRoles(["ROLE_ANIMATEUR"]);

        $manager->persist($animateur);

        
    }
    $manager->flush();
}
}
