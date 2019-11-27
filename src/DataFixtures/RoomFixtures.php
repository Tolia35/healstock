<?php

namespace App\DataFixtures;

use App\Entity\Room;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoomFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $room1 = new Room();
        $room1->setName("bloc1");
        $manager->persist($room1);
        $this->setReference("room1", $room1);

        $room2 = new Room();
        $room2->setName("bloc2");
        $manager->persist($room2);
        $this->setReference("room2", $room2);

        $room3 = new Room();
        $room3->setName("bloc3");
        $manager->persist($room3);
        $this->setReference("room3", $room3);

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
           ItemFixtures::class,
           ChecklistFixtures::class
       ];
   }
}
