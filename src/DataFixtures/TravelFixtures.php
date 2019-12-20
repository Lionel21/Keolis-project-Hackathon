<?php


namespace App\DataFixtures;

use App\Entity\Travel;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class TravelFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        for ($i = 0; $i <= 10; $i++) {
            $travel = new Travel();
            $travel->setDistance($faker->biasedNumberBetween(500, 20000));
            $travel->setDuration($faker->unixTime (7200 / 60));
            $travel->setCalory($faker->randomNumber($nbDigits = 3, $strict = true));

            $travel->setUser($this->getReference('travel_' . rand(0,9)));
            $manager->persist($travel);
        }
            $manager->flush();
    }

    public function getDependencies()
    {
        return [UserFixtures::class];
    }

}
