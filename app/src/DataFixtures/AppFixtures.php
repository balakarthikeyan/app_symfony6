<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\MicroPost;
use App\Entity\UserProfile;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    ) {}

    public function load(ObjectManager $manager): void
    {
        $user1 = new User();
        $user1->setEmail('test@symfony6.com');
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

        $microPost1 = new MicroPost();
        $microPost1->setTitle('Welcome to Poland!');
        $microPost1->setText('Welcome to Poland!');
        $microPost1->setAuthor($user1);
        $manager->persist($microPost1);

        $microPost2 = new MicroPost();
        $microPost2->setTitle('Welcome to US!');
        $microPost2->setText('Welcome to US!');
        $microPost2->setAuthor($user1);
        $manager->persist($microPost2);

        $microPost3 = new MicroPost();
        $microPost3->setTitle('Welcome to Germany!');
        $microPost3->setText('Welcome to Germany!');
        $microPost3->setAuthor($user1);
        $manager->persist($microPost3);

        $manager->flush();
    }
}
