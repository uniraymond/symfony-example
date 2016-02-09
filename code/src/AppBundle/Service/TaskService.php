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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Routing\Router;

class TaskService
{
    protected $em;
    protected $route;

    public function __construct(EntityManager $em, Router $route)
    {
        $this->em = $em;
        $this->route = $route;
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
                'tag' => $task->getTag(),
                'removeUrl' => $this->route->generate('task_delete', array('id'=>$task->getId()),false),
                'updateStatusUrl' => $this->route->generate('task_update_status', array('id'=>$task->getId()), false)
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

    /**
     * @param $id
     * @param $status
     */
    public function changeTaskStatus($id, $status)
    {
        $entity = $this->em->getRepository('AppBundle:Task')->find($id);
        if (!$entity) {
            throw $this->createNoteFoundException('Unable to find the task');
        }

        $entity->setStatus($status);
        $this->em->flush();

        return;
    }
}