<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Quartier;
class QuartierFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 7; $i++) {
            $Faker = Factory::create("fr_FR");
            $quartier = new Quartier();
            $quartier->setNomQuartier($Faker->streetName());
            

            $manager->persist($quartier);

            $manager->flush();
        }
    }
}
