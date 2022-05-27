<?php

namespace App\DataFixtures;

use App\Entity\Ingredient;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {

        for ($i=1; $i < 50; $i++){
        $ingredient = new Ingredient();
        $ingredient->setName('Ingredient ' . $i)
           ->setPrice(mt_rand(0, 100));

        $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
