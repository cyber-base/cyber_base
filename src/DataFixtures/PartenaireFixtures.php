<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Partenaire;
class PartenaireFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=1; $i <7; $i++) { 
            $Faker = Factory::create("fr_FR");
            $partenaire = new Partenaire();

            $partenaire->setNomEtablissement($Faker->streetName())
                       ->setTypeEtablissement($Faker->streetName());
            $manager->persist($partenaire);
        }

        $manager->flush();
    }
}
