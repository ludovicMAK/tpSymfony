<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $project = new Project();
            $project->setDescription("This is the description for Project $i");
            $project->setDateStart(new \DateTime("-{$i} days")); // Example start date
            $project->setDateEnd(new \DateTime("+{$i} days"));   // Example end date

            // Associating a random user (make sure users exist in UserFixtures)
            $project->setIdUser($this->getReference("user_" . rand(1, 5), User::class));

            $manager->persist($project);

            // Adding a reference for use in other fixtures
            $this->addReference("project_$i", $project);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class, // Ensure UserFixtures are loaded first
        ];
    }
}
