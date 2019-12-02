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
        $checklistitem1->setChecklist($this->getReference("checklist1"));
        $checklistitem1->setItem($this->getReference("item1"));
        $manager->persist($checklistitem1);

        $checklistitem2 = new Checklistitem();
        $checklistitem2->setIsClosed(false);
        $checklistitem2->setChecklist($this->getReference("checklist1"));
        $checklistitem2->setItem($this->getReference("item2"));
        $manager->persist($checklistitem2);

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
            ChecklistFixtures::class,
            ItemFixtures::class
        ];
    }
}
