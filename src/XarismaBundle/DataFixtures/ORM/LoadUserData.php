<?php
// src/XarismaBundle/DataFixtures/ORM/LoadUserData.php

namespace XarismaBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use XarismaBundle\Entity\User;

class LoadUserData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 2;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setPassword('admin');
        $user->setFirstname('Admin User');
        $user->setDeleted(0);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('dbriggs');
        $user->setPassword('dbriggs');
        $user->setFirstname('Don');
        $user->setLastname('Briggs');
        $user->setDeleted(0);
        $manager->persist($user);

        $user = new User();
        $user->setUsername('gbrown');
        $user->setPassword('gbrown');
        $user->setFirstname('Gregg');
        $user->setLastname('Brown');
        $user->setDeleted(0);
        $manager->persist($user);

        $manager->flush();
    }
}