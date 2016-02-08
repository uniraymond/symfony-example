<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use AppBundle\Entity\Task;
use AppBundle\Form\taskType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class TaskController
 * @package AppBundle\Controller
 * @author Raymond F. <raymond@studionone.com.au>
 */
Class TaskController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/task", name="task_list")
     * @param $name
     */
    public function indexAction($name = null)
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('AppBundle:Task')->findAll();

        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);

        return $this->render('AppBundle:Task:index.html.twig',
                array(
                    'name'          =>  $name,
                    'entities'      =>  $entities,
                    'form'          =>  $form->createView()
            ));
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/task/show/{id}", name="task_show")
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AppBundle:Task')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('The task is not exist.');
        }

        return $this->render('AppBundle:Task:show.html.twig',
                array(
                    'entity' => $entity
            ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/task/new", name="task_new")
     */
    public function newAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(new TaskType(), $task);
        $form->handleRequest($request);

        if (!$form->isSubmitted() || !$form->isValid()) {
            throw $this->createNotFoundException('No data has been submitted');
        }

        //use task service to do the save form and return array.
        $taskService = $this->get('example_app.service.task');
        $savedTask = $taskService->addTask($task);

        $response = new Response(json_encode($savedTask));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/task/create", name="task_create")
     */
    public function createAction(Request $request)
    {
        $task = new Task();
        $form = $this->createForm(new TaskType(), $task);

        return $this->render('AppBundle:Task:new.html.twig',
                array(
                    'entity' => $task,
                    'form' => $form->createView()
            ));
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     * @Route("/task/delete/{id}", name="task_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $taskService = $this->get('example_app.service.task');
        $deleteTask = $taskService->deleteTask($id);

        $task = new Task();
        $form = $this->createForm(new TaskType(), $task);

        $response = new Response(json_encode(array('id'=>$id)));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}