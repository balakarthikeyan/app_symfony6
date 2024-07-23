<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\UserProfile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('foo@symfony6.com');
        $user1->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user1,
                '12345678'
            )
        );
        $manager->persist($user1);

        $profile1 = new UserProfile();
        $profile1->setUser($user1);
        $manager->persist($profile1);

        $user2 = new User();
        $user2->setEmail('bar@symfony6.com');
        $user2->setPassword(
            $this->userPasswordHasher->hashPassword(
                $user2,
                '12345678'
            )
        );
        $manager->persist($user2);
        
        $profile2 = new UserProfile();
        $profile2->setUser($user2);
        $manager->persist($profile2);

        $manager->flush();
    }
}
