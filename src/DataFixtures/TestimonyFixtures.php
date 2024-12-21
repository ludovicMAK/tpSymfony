<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Testimony;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TestimonyFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $testimony = new Testimony();
            $testimony->setContent("This is the content of testimony $i.");
            $testimony->setDate(new \DateTime());
            $userReference = $this->getReference("user_" . $i, User::class);
            $testimony->setIdUser($userReference);
            $projectReference = $this->getReference("project_$i", Project::class);
            $testimony->setProject($projectReference);

            $manager->persist($testimony);

            // Ajouter une référence pour une utilisation ultérieure
            $this->addReference("testimony_$i", $testimony);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class, // Charger les utilisateurs avant les témoignages
            ProjectFixtures::class, // Charger les projets avant les témoignages
        ];
    }
}
