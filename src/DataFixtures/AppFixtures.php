<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Account;
use App\Entity\Link;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private readonly UserPasswordHasherInterface $hasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));
        
        //tableau de comptes
        $accounts = [];
        //Création de 10 comptes
        for ($i = 0; $i < 10; $i++) {
            //Créer un objet Account
            $account = new Account();
            $firstname = $faker->firstName();
            $lastname = $faker->lastName();
            $account
                ->setFirstname($firstname)
                ->setLastname($lastname)
                ->setEmail(
                    $firstname . 
                    $lastname . 
                    '@'. 
                    $faker->freeEmailDomain()
                )
                ->setPassword(
                    $this->hasher->hashPassword($account, $faker->word())
                )
                ->setRoles(['ROLE_USER'])
                ->setImg($faker->imageUrl(200,200));
            //Persister
            $manager->persist($account);
            $accounts[] = $account;
        }

        //Tableau de categories
        $categories = [];
        //Création de 30 categories
        for ($i = 0; $i < 30; $i++) {
            //Créer un objet Category
            $category = new Category();
            $category->setName($faker->unique()->word());
            //Persister
            $manager->persist($category);
            $categories[] = $category;
        }

        for ($i=0; $i <100; $i++) {
            //Créer un objet Link 
            $link = new Link();
            $link
                ->setUrl($faker->unique()->url())
                ->setIcon($faker->imageUrl(200,200))
                ->setName($faker->word())
                ->setDescription($faker->sentence(20))
                ->setCreatedAt(new \DateTimeImmutable($faker->date('Y-m-d')))
                ->setAccount($accounts[$faker->numberBetween(0, 9)])
                ->addCategory($categories[$faker->numberBetween(0, 9)])
                ->addCategory($categories[$faker->numberBetween(10, 19)])
                ->addCategory($categories[$faker->numberBetween(20, 29)]);
            //Persister
            $manager->persist($link);
        }
        
        //Sauvegarder en BDD
        $manager->flush();
    }
}
