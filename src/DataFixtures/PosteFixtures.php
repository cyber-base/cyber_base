<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Poste;

class PosteFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 7; $i++) {
            $Faker = Factory::create("fr_FR");
            $poste = new Poste();
            $poste->setLibelle($Faker->name())
                ->setTypePoste($Faker->title());

            $manager->persist($poste);

            $manager->flush();
        }
    }
}
