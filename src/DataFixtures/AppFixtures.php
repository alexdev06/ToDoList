<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Task;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
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

        // Admin role
        $user = new User();
        $user->setUsername('alex06');
        $user->setEmail('alex06@gmail.com');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $user->setRoles(['ROLE_ADMIN']);
        $manager->persist($user);

        for ($a = 0; $a < 3; $a++) {
            $task = new Task();
            $task->setTitle($faker->sentence());
            $task->setContent($faker->paragraph());
            $task->setUser($user);
            $manager->persist($task);
        }

        // User role
        $user = new User();
        $user->setUsername('ludo06');
        $user->setEmail('ludo06@gmail.com');
        $user->setPassword($this->encoder->encodePassword($user, 'password'));
        $user->setRoles(['ROLE_USER']);
        $manager->persist($user);

        for ($b = 0; $b < 3; $b++) {
            $task = new Task();
            $task->setTitle($faker->sentence());
            $task->setContent($faker->paragraph());
            $task->setUser($user);
            $manager->persist($task);
        }

        // Other differents users with tasks
        for ($i = 0; $i < 5; $i++) {
            $user = new User();
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

            for ($j = 0; $j < 3; $j++) {
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

        // Anonymous task
        $task = new Task();
        $task->setTitle('titre');
        $task->setContent($faker->paragraph());
        $manager->persist($task);
        
        $manager->flush();
    }
}
