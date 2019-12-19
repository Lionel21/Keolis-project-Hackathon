<?php


namespace App\DataFixtures;


use App\Entity\Travel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TravelFixtures extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i = 5; $i++) {
            $travelFaker = new Travel();
            $travelFaker->setDistance($faker->biasedNumberBetween(500, 20000));
            $this->addReference('travel_' . $i);
            $manager->persist($travelFaker);
        }
            $manager->flush();
    }
}
