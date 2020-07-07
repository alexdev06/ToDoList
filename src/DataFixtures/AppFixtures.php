<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr-FR');

        for ($i = 0; $i < 10; $i++) {
            $user = new User;
            $user->setUsername($faker->userName);
            $user->setEmail($faker->email);
            $user->setPassword($this->encoder->encodePassword($user, 'password'));
            $manager->persist($user);
        }

        for ($i = 0; $i < 20; $i++) {
            $task = new Task();
            $task->setTitle($faker->sentence());
            $task->setContent($faker->paragraph());
            $manager->persist($task);
        }

        $manager->flush();
    }
}
