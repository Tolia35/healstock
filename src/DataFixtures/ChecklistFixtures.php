<?php

namespace App\DataFixtures;

use App\Entity\Checklist;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ChecklistFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $checklist1 = new Checklist();
        $checklist1->setNurseName("Evelyne Colliot");
        $checklist1->setCreateTime(new \DateTime("2019-05-12"));
        $checklist1->addRoom($this->getReference("bloc1"));
        $checklist1->setItem($this->getReference("item1"));
        $manager->persist($checklist1);
        $this->setReference("checklist1", $checklist1);

        $checklist2 = new Checklist();
        $checklist2->setNurseName("Patrick Charlard");
        $checklist2->setCreateTime(new \DateTime("2019-03-19"));
        $checklist2->addRoom($this->getReference("bloc2"));
        $checklist2->setItem($this->getReference("item1","item2"));
        $manager->persist($checklist2);
        $this->setReference("checklist2", $checklist2);

        $checklist3 = new Checklist();
        $checklist3->setNurseName("Olivier Guillard");
        $checklist3->setCreateTime(new \DateTime("2019-03-23"));
        $checklist3->addRoom($this->getReference("bloc2"));
        $checklist3->setItem($this->getReference("item2","item3"));
        $manager->persist($checklist3);
        $this->setReference("checklist3", $checklist3);

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
