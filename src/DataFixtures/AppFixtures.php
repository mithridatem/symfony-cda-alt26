<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        for ($i=0; $i < 20; $i++) { 
            //Créer un objet
            $category = new Category();
            $category->setName($faker->unique()->jobTitle());
            //Persister
            $manager->persist($category);
        }
        

        //Sauvegarder en BDD
        $manager->flush();
    }
}
