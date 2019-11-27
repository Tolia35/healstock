<?php

namespace App\DataFixtures;

use App\Entity\Roomitem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class RoomItemFixturesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $roomitem1 = new Roomitem();
        $roomitem1->setQuantity(10);
        $manager->persist($roomitem1);
        $this->setReference("roomitem1", $roomitem1);

        $roomitem2 = new Roomitem();
        $roomitem2->setQuantity(1);
        $manager->persist($roomitem1);
        $this->setReference("roomitem2", $roomitem2);

        $roomitem3 = new Roomitem();
        $roomitem3->setQuantity(300);
        $manager->persist($roomitem3);
        $this->setReference("roomitem3", $roomitem3);

        $manager->flush();
    }
}
