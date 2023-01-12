<?php

namespace App\DataFixtures;

use App\Entity\Tweet;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $users = [];

        $faker = Factory::create();

        for ($x = 0; $x < 3; $x++)
        {
            $user = new User();
            $user->setName($faker->name());
            $user->setUsername(substr($faker->userName() ,0, 15));
            $user->setPassword("0mrY17&12$");
            $user->setCreatedAt($faker->dateTimeInInterval('-1 year'));
            $user->setVerified(true);

            $manager->persist($user);

            $users[] = $user;
        }

        for ($i = 0; $i < 30; $i++)
        {
            $tweet = new Tweet();
            $tweet->setAuthor($users[array_rand($users)]);
            $tweet->setCreatedAt($faker->dateTimeInInterval('-1 year', '1 year'));
            $tweet->setText($faker->text(280));
            $tweet->setLikeCount(0);
            $manager->persist($tweet);
        }

        $manager->flush();
    }
}
