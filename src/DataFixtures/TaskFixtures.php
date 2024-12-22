<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\Task;
use App\Enum\EnumTaskStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class TaskFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {

        $project1 = $this->getReference('project_1', Project::class); // Assurez-vous d'avoir créé des projets comme fixtures
        $project2 = $this->getReference('project_2', Project::class);

        // Création de 3 tâches pour chaque projet
        for ($i = 1; $i <= 3; $i++) {
            $task = new Task();
            $task->setTitle('Tâche ' . $i . ' - ' . $project1->getName())
                ->setDescription('Description de la tâche ' . $i)
                ->setStatus(EnumTaskStatus::PENDING) // Le statut peut être 'En attente'
                ->setCreatedAt(new \DateTimeImmutable()) // Date de création
                ->setProject($project1);

            $manager->persist($task);
        }

        for ($i = 4; $i <= 6; $i++) {
            $task = new Task();
            $task->setTitle('Tâche ' . $i . ' - ' . $project2->getName())
                ->setDescription('Description de la tâche ' . $i)
                ->setStatus(EnumTaskStatus::IN_PROGRESS) // Le statut peut être 'En cours'
                ->setCreatedAt(new \DateTimeImmutable()) // Date de création
                ->setProject($project2);


            $manager->persist($task);
        }
        for ($i = 1; $i <= 3; $i++) {
            $task = new Task();
            $task->setTitle('Tâche ' . $i . ' - ' . $project1->getName())
                ->setDescription('Description de la tâche ' . $i)
                ->setStatus(EnumTaskStatus::FINISHED) // Le statut peut être 'Fini'
                ->setCreatedAt(new \DateTimeImmutable()) // Date de création
                ->setProject($project1);

            $manager->persist($task);
        }

        // Sauvegarder les entités en base de données
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjectFixtures::class, // Charger les projets avant les tâches
        ];
    }
}
