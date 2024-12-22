<?php

namespace App\DataFixtures;

use App\Entity\Project;
use App\Entity\User;
use App\Enum\EnumProject;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProjectFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Les statuts à assigner manuellement
        $statusValues = [
            EnumProject::IN_PROGRESS,  // En cours
            EnumProject::IN_PROGRESS,  // En cours
            EnumProject::PENDING,      // En attente
            EnumProject::PENDING,      // En attente
            EnumProject::PENDING,      // En attente
            EnumProject::FINISHED,     // Fini
            EnumProject::FINISHED,     // Fini
        ];

        // Créer les projets avec les statuts spécifiés
        foreach ($statusValues as $index => $status) {
            $project = new Project();
            $project->setName("Project " . ($index + 1)); // Exemple de nom : Project 1, Project 2, etc.
            $project->setDescription("This is the description for Project " . ($index + 1));
            $project->setDateStart(new \DateTime("-" . ($index + 1) . " days")); // Exemple de date de début
            $project->setDateEnd(new \DateTime("+" . ($index + 1) . " days"));   // Exemple de date de fin

            // Assigner le statut spécifique
            $project->setStatus($status);

            // Assigner un utilisateur au projet (en supposant que les utilisateurs existent dans UserFixtures)
            $project->setIdUser($this->getReference("user_" . rand(1, 5), User::class));

            // Persister le projet
            $manager->persist($project);

            // Ajouter une référence pour pouvoir l'utiliser dans d'autres fixtures
            $this->addReference("project_" . ($index + 1), $project);
        }

        // Sauvegarder toutes les entités dans la base de données
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class, // Ensure UserFixtures are loaded first
        ];
    }
}
