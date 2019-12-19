<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Faker;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');


        $subscriber = new User();

        $subscriber->setEmail('subscriber@monsite.com');
        $subscriber->setLastname($faker->name);
        $subscriber->setFirstname($faker->name);
        $subscriber->setRoles(['ROLE_SUBSCRIBER']);
        $subscriber->setPassword($this->passwordEncoder->encodePassword(
            $subscriber,
            'subpsw'
        ));

        $manager->persist($subscriber);

        for ($i = 0; $i < 100; $i++) {

            $sub = new User();

            $sub->setEmail($faker->email);
            $sub->setLastname($faker->name);
            $sub->setFirstname($faker->name);
            $sub->setAge($faker->biasedNumberBetween(15, 80));
            $sub->setTaille($faker->biasedNumberBetween(120, 220));
            $sub->setWeight($faker->biasedNumberBetween(20, 150));
            $sub->setRoles(['ROLE_SUBSCRIBER']);
            $sub->setPassword($this->passwordEncoder->encodePassword(
                $sub,
                'testsub'
            ));
            $manager->persist($sub);
        }



        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setLastname($faker->name);
        $admin->setFirstname($faker->name);
        $admin->setPassword($this->passwordEncoder->encodePassword(
            $admin,
            'adpsw'
        ));

        $manager->persist($admin);

        $manager->flush();
    }
}
