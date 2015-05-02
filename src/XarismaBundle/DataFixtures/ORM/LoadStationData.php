<?php
// src/XarismaBundle/DataFixtures/ORM/LoadStationData.php

namespace XarismaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use XarismaBundle\Entity\Station;

class LoadStationData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 4;
    }
    
    public function load(ObjectManager $manager)
    {
        $station = new Station();
        $station->setStationcode('RIPDR1');
        $station->setDescription("RIP Station 1 (Durst)");
        $station->setDeleted(0);
        $manager->persist($station);

        $station = new Station();
        $station->setStationcode('RIPDR2');
        $station->setDescription("RIP Station 2 (Durst)");
        $station->setDeleted(0);
        $manager->persist($station);

        $station = new Station();
        $station->setStationcode('RIPDP1');
        $station->setDescription("RIP Station 1 (Duponte)");
        $station->setDeleted(0);
        $manager->persist($station);

        $station = new Station();
        $station->setStationcode('RIPDP1');
        $station->setDescription("RIP Station 1 (Duponte)");
        $station->setDeleted(0);
        $manager->persist($station);

        $manager->flush();
    }
}