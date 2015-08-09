<?php
// src/XarismaBundle/DataFixtures/ORM/LoadCustorderData.php

namespace XarismaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use XarismaBundle\Entity\Custorder;

class LoadCustorderData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder() {
        return 5;
    }
    public function load(ObjectManager $manager)
    {
        $order = new Custorder();
//        Church on Wheels
        $order->setCustomerId(12975);
        $order->setOrdernumber(139378);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Tidmore Flags
        $order->setCustomerId(10719);
        $order->setOrdernumber(139379);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Tidmore Flags
        $order->setCustomerId(10719);
        $order->setOrdernumber(139450);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Americanflagstore.com INC
        $order->setCustomerId(12758);
        $order->setOrdernumber(139380);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
        
        $order = new Custorder();
//        Americanflagstore.com INC
        $order->setCustomerId(12758);
        $order->setOrdernumber(139381);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
        
        $order = new Custorder();
//        Flutter Flag Source
        $order->setCustomerId(13276);
        $order->setOrdernumber(139383);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Carrot-Top Industries, Inc.
        $order->setCustomerId(13884);
        $order->setOrdernumber(139386);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Carrot-Top Industries, Inc.
        $order->setCustomerId(13884);
        $order->setOrdernumber(139456);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Oats Flag Co. Inc
        $order->setCustomerId(11157);
        $order->setOrdernumber(139394);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Oats Flag Co. Inc
        $order->setCustomerId(11157);
        $order->setOrdernumber(139395);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Oats Flag Co. Inc
        $order->setCustomerId(11157);
        $order->setOrdernumber(139396);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        Oats Flag Co. Inc
        $order->setCustomerId(11157);
        $order->setOrdernumber(139447);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);
  
        $order = new Custorder();
//        US Flag Supply
        $order->setCustomerId(14584);
        $order->setOrdernumber(139389);
        $order->setOrderstatus('RECEIVED');
        $order->setUpdateby(1);
        $order->setDeleted(0);
        $manager->persist($order);

        $manager->flush();
    }
}