<?php

namespace App\DataFixtures;

use App\Entity\Serie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SerieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < 1000; $i++) {
            $serie = new Serie();
            $serie->setName($faker->realText(30))
                  ->setOverview($faker->paragraph(10))
                  ->setGenre($faker->randomElement(['Drama', 'Action', 'Comedy', 'Horror']))
                  ->setStatus($faker->randomElement(['Returning', 'Ended', 'Canceled']))
                  ->setVote($faker->randomFloat(2, 0, 10))
                  ->setPopularity($faker->randomFloat(2, 200, 900))
                  ->setFirstAirDate($faker->dateTimeBetween('-10 year', 'now'))
                  ->setDateCreated(new \DateTime())   // date à déclarer manuellement étant donner que c'est la date "now"
            ;

            if ($serie->getStatus() !== 'Returning') {
                $serie->setLastAirDate($faker->dateTimeBetween($serie->getFirstAirDate(), '-1 day'));
            }
            $manager->persist($serie);
        }

        $manager->flush();
    }
}
