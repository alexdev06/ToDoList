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
            $role = mt_rand(1, 2);
            // To set user with ROLE_ADMIN or with ROLE_USER
            if ($role == 1) {
                $user->setRoles(['ROLE_ADMIN']);
            } else {
                $user->setRoles(['ROLE_USER']);
            }

            $manager->persist($user);

            for ($j = 0; $j < 5; $j++) {
                $task = new Task();
                $task->setTitle($faker->sentence());
                $task->setContent($faker->paragraph());
                $anonyme = mt_rand(1,2);
                // To link task with an user
                if ($anonyme == 1) {
                    $task->setUser($user);
                }
                
                $manager->persist($task);
            }
        }

        $manager->flush();
    }
}
