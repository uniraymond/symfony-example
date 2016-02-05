<?php
/**
 * Created by PhpStorm.
 * User: raymond
 * Date: 4/02/2016
 * Time: 5:15 PM
 */

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Task;
/**
 * status 1: preparing
 * status 2: pending
 * status 3: excuting
 * status 4: finished
 * status 5: redo
 */
class LoadTaskData extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $task1 = new Task();
        $task1->setUser($manager->merge($this->getReference('user_one')));
        $task1->setName('Setup Computer');
        $task1->setStatus(4);
        $task1->setTag('Task A');
        $task1->setStartAt(new \DateTime('-3 days'));
        $task1->setFinishAt(new \DateTime('-2 days'));
        $task1->setContent('Setup the new computer!');

        $task2 = new Task();
        $task2->setUser($manager->merge($this->getReference('user_two')));
        $task2->setName('Install all software as required');
        $task2->setStatus(5);
        $task1->setTag('Task B');
        $task2->setStartAt(new \DateTime('-2 days'));
        $task2->setFinishAt(new \DateTime('-1 days'));
        $task2->setContent('Install all software for the new computere');

        $task3 = new Task();
        $task3->setName('Setup Table');
        $task3->setUser($manager->merge($this->getReference('user_three')));
        $task3->setStatus(3);
        $task1->setTag('Task A');
        $task3->setStartAt(new \DateTime('-1 days'));
        $task3->setFinishAt(new \DateTime());
        $task3->setContent('Install tables for the computer!');

        $task4 = new Task();
        $task4->setName('Prepare the stationary for staffs');
        $task4->setUser($manager->merge($this->getReference('user_one')));
        $task4->setStatus(2);
        $task1->setTag('Task A');
        $task4->setStartAt(new \DateTime('+2 days'));
        $task4->setFinishAt(new \DateTime('+3 days'));
        $task4->setContent('Collect all stationary for staffs!');

        $task5 = new Task();
        $task5->setUser($manager->merge($this->getReference('user_three')));
        $task5->setName('Grab chair for staff');
        $task5->setStatus(1);
        $task1->setTag('Task C');
        $task5->setStartAt(new \DateTime('+4 days'));
        $task5->setFinishAt(new \DateTime('+5 days'));
        $task5->setContent('Get chair for staff!');

        $manager->persist($task1);
        $manager->persist($task2);
        $manager->persist($task3);
        $manager->persist($task4);
        $manager->persist($task5);

        $manager->flush();
    }

    public function getOrder()
    {
        return 2; // the order in which fixture will be loaded
    }
}