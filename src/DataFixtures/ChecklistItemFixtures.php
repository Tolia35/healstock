<?php

namespace App\DataFixtures;

use App\Entity\Checklistitem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChecklistItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $checklistitem1 = new Checklistitem();
        $checklistitem1->setIsClosed(false);
        $manager->persist($checklistitem1);
        $this->setReference("checklistitem1", $checklistitem1);

        $checklistitem2 = new Checklistitem();
        $checklistitem2->setIsClosed(true);
        $manager->persist($checklistitem2);
        $this->setReference("checklistitem2", $checklistitem2);

        $manager->flush();
    }
    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
            RoomFixtures::class,
            ItemFixtures::class
        ];
    }
}
