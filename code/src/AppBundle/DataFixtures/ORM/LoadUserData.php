<?php
namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use AppBundle\Entity\User;


class LoadUserData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $userAdmin = new User();
        $userAdmin->setFname('Ade');
        $userAdmin->setLname('Arce');
        $userAdmin->setEmail('ade@example.com.studionone');
        $userAdmin->setPassword('password');

        $userAdmin2 = new User();
        $userAdmin2->setFname('Bob');
        $userAdmin2->setLname('Brush');
        $userAdmin2->setEmail('bob@example.com.studionone');
        $userAdmin2->setPassword('password');

        $userAdmin3 = new User();
        $userAdmin3->setFname('Cat');
        $userAdmin3->setLname('Capther');
        $userAdmin3->setEmail('cat@example.com.studionone');
        $userAdmin3->setPassword('password');

        $manager->persist($userAdmin);
        $manager->persist($userAdmin2);
        $manager->persist($userAdmin3);

        $manager->flush();

        $this->addReference('user_one', $userAdmin);
        $this->addReference('user_two', $userAdmin2);
        $this->addReference('user_three', $userAdmin3);
    }

    public function getOrder()
    {
        return 1; //order which load will be the first.
    }
}