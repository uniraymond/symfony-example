<?php
/**
 * Created by PhpStorm.
 * User: raymond
 * Date: 8/02/2016
 * Time: 2:43 PM
 */

namespace AppBundle\Service;


use Symfony\Component\BrowserKit\Request;
use Doctrine\ORM\EntityManager;

class TaskService
{
    protected $em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param $task
     * @return array
     */
    public function addTask($task)
    {
        $this->em->persist($task);
        $this->em->flush();

        $checked = $task->getStatus() ? 'checked' : '';

        return array(
                'id' => $task->getId(),
                'checked' => $checked,
                'name' => $task->getName(),
                'status' => $task->getStatus(),
                'tag' => $task->getTag()
            );
    }

    /**
     * @param $id
     * @return null
     */
    public function deleteTask($id)
    {
        $entity = $this->em->getRepository('AppBundle:Task')->find($id);
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find the task');
        }

        $this->em->remove($entity);
        $this->em->flush();
        return;
    }

    public function changeTaskStatus($id, $request)
    {

    }
}