<?php

namespace App\DataFixtures;

use App\Factory\CategoryFactory;
use App\Factory\PostFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;

class AppFixtures extends Fixture
{
    private Generator $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

     /**
     * @see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#model-factories
     *
     * @todo add your default values here
     */

    public function load(ObjectManager $manager): void
    {

        // Catégories : 
        $categories = [
            '#Voyage',
            '#Cinéma',
            '#Musique',
            '#Cuisine',
            '#Voiture',
            '#Divers',
            '#Programmation',
            '#Loisir',
            '#Sport',
            '#Immobilier',
            '#Série TV',
            '#Livre/Mangas'
        ];

             // Catégories
             CategoryFactory::createMany(count($categories), static function (int $i) use ($categories) {
                return ['name' => $categories[$i - 1]];
            });

        // Création de l'utilisateur admin
        $admin = UserFactory::createOne([
            'email' => 'admin@symfoblog.dev',
            'pseudo' => 'admin',
            'password' => 'adminadmin',
            'roles' => ['ROLE_ADMIN']
        ]);

        PostFactory::createMany(10, [
            'author' => $admin,
        ]);

        // Utilisateurs
        UserFactory::createMany(10);

        // Posts : 
        PostFactory::createMany(50);

        $manager->flush();
    }
}
