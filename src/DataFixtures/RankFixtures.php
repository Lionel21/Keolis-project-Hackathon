<?php


namespace App\DataFixtures;


use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class RankFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 5; $i++) {
            $rankFaker = new User();
            $rankFaker->setFirstname($faker->name);
            $manager->persist($rankFaker);
            $manager->flush();
        }
    }

}
