<?php

namespace App\DataFixtures;

use App\Entity\Roomitem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoomItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $roomitem1 = new Roomitem();
        $roomitem1->setQuantity(10);
        $roomitem1->setRoom($this->getReference("room1"));
        $roomitem1->setItem($this->getReference("item1"));
        $manager->persist($roomitem1);
        $this->setReference("roomitem1", $roomitem1);

        $roomitem2 = new Roomitem();
        $roomitem2->setQuantity(1);
        $roomitem2->setRoom($this->getReference("room2"));
        $roomitem2->setItem($this->getReference("item2"));
        $manager->persist($roomitem1);
        $this->setReference("roomitem2", $roomitem2);

        $roomitem3 = new Roomitem();
        $roomitem3->setQuantity(300);
        $roomitem3->setRoom($this->getReference("room1"));
        $roomitem3->setItem($this->getReference("item2"));
        $manager->persist($roomitem3);
        $this->setReference("roomitem3", $roomitem3);

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
            ItemFixtures::class,
        ];
    }
}
