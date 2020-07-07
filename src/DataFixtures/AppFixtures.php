<?php

namespace App\DataFixtures;

use App\Entity\Activite;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        //Je gère les activités
        for ($i = 0; $i < 50; $i++){
            $activite = new Activite();
            $activite->setDateActivite($faker->dateTimeBetween('-30 days', 'now'))
                     ->setTitre($faker->sentence(4))
                     ->setContenu($faker->sentence(20))
                     ->setDepartement('Vendée')
                     ->setVille($faker->city)
                     ->setNoteActivite(mt_rand(1, 5))
            ;
            $manager->persist($activite);
        }

        //Je gère les articles
        for ($j = 0; $j < 50; $j++){
            $article = new Article();
            $article->setTitre($faker->sentence(3))
                    ->setContenu($faker->sentence(100))
                    ->setIntro($faker->sentence(20))
                    ->setVille($faker->city)
                    ->setDepartement('Vendée')
                    ->setDate($faker->dateTimeBetween('-30 days', 'now'))
                    ->setNoteCamping(mt_rand(1, 5))
            ;
            $manager->persist($article);
        }



        $manager->flush();
    }
}
