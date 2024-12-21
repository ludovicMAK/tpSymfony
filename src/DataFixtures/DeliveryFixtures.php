<?php

namespace App\DataFixtures;

use App\Entity\Delivery;
use App\Entity\Project;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DeliveryFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 5; $i++) {
            $delivery = new Delivery();
            $delivery->setName("Delivery $i");
            $delivery->setType("Type $i"); // Replace with actual types if needed
            $delivery->setDateDelivery(new \DateTime("+{$i} days")); // Example delivery dates

            // Associating a random project (make sure projects exist in ProjectFixtures)
            $delivery->setIdProject($this->getReference("project_" . rand(1, 5), Project::class));

            $manager->persist($delivery);

            // Adding a reference for use in other fixtures
            $this->addReference("delivery_$i", $delivery);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ProjectFixtures::class, // Ensure ProjectFixtures are loaded first
        ];
    }
}
