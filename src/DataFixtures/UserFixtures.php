<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $roles = ['ROLE_ADMIN', 'ROLE_USER', 'ROLE_BANNED'];

        for ($i = 1; $i <= 10; $i++) {
            $user = new User();
            $user->setEmail("user$i@example.com");
            $user->setFirstname("FirstnameUser$i");
            $user->setLastname("LastnameUser$i");
            $user->setPassword(
                $this->passwordHasher->hashPassword($user, 'password')
            );
            $user->setRoles([$roles[array_rand($roles)]]);
            $manager->persist($user);

            // Adding a reference for use in other fixtures
            $this->addReference("user_$i", $user);
        }
        $user = new User();
        $user->setEmail("ludovic93mak@gmail.com");
        $user->setFirstname("Ludovic");
        $user->setLastname("Ludovic");
        $user->setPassword(
            $this->passwordHasher->hashPassword($user, 'password')
        );
        $user->setRoles([$roles[array_rand($roles)]]);
        $manager->persist($user);
        $this->addReference("user_11", $user);
        $manager->flush();
    }
}
