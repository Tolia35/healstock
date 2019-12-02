<?php

namespace App\DataFixtures;

use App\Entity\Item;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ItemFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $item1 = new Item();
        $item1->setReference("Morphine 12546332");
        $item1->setInformation("40g");
        $manager->persist($item1);
        $this->setReference("item1", $item1);

        $item2 = new Item();
        $item2->setReference("Anticoexileoum 1255433");
        $item2->setInformation("ampoule");
        $manager->persist($item2);
        $this->setReference("item2", $item2);

        $item3 = new Item();
        $item3->setReference("Mariaduriumis 124523355");
        $item3->setInformation("ampoule 5g");
        $manager->persist($item3);
        $this->setReference("item3", $item3);

        $manager->flush();
    }
}
