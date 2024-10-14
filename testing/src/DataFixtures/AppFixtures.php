<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) {
            $project = new Project();
            $project->setName($faker->name);
            $project->setDescription($faker->realText(100));
            // $project->setDate(new \DateTime(sprintf('-%d days', rand(1, 100))));
            $manager->persist($project);
        }

        $manager->flush();
    }
}

