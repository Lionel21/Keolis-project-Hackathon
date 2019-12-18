<?php

namespace App\DataFixtures;

use App\Entity\Sexe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class SexeFixtures extends Fixture
{
    const GENDER = [
        'Homme',
        'Femme',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::GENDER as $key => $name) {
            $sexe = new Sexe();
            $sexe->setName($name);
            $manager->persist($sexe);
        }

        $manager->flush();
    }


}
