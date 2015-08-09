<?php
// src/XarismaBundle/DataFixtures/ORM/LoadDictionaryData.php

namespace XarismaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use XarismaBundle\Entity\Dictionary;

class LoadDictionaryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 1;
    }
    
    public function load(ObjectManager $manager)
    {
        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('RECEIVED');
        $dictionary->setDefinition('received');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('RECEIVED');
        $dictionary->setDefinition('received');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('HOLD_CUST');
        $dictionary->setDefinition('Hold for customer contact');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('HOLD_MATERIAL');
        $dictionary->setDefinition('Hold for Material to arrive');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('HOLD_OTHER');
        $dictionary->setDefinition('Hold for other reason');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('PRODUCTION');
        $dictionary->setDefinition('In Production');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('SHIP_READY');
        $dictionary->setDefinition('Awaiting Shipping');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('SHIP_HOLD');
        $dictionary->setDefinition('Shipping On Hold');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);

        $dictionary = new Dictionary();
        $dictionary->setClass('order_status');
        $dictionary->setTerm('SHIP_SHIPPED');
        $dictionary->setDefinition('Shipped');
        $dictionary->setDeleted(0);
        $manager->persist($dictionary);


        $manager->flush();
    }
}