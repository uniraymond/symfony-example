<?php

namespace AppBundle\Controller;

use AppBundle\AppBundle;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }

    /**
     * @Route("/name/{lastName}", name="name_test")
     */
    public function nameAction($lastName)
    {
        /**
         * @var \AppBundle\Service\NameService $nameService
         */
        $nameService = $this->get('example_app.service.name');

        $name = $nameService->appendLastName($lastName);

        $nameService->temporarilySaveName($name);

        return $this->render('default/name-test.html.twig', [
            'name' => $name,
            'hello' => 'goodbye'
        ]);
    }

    /**
     * @Route("/email/{name}", name="name_test")
     * @param $name
     */
    public function emailAction($name)
    {
        /**
         * @var \AppBundle\Service\EmailService $emailService
         */
        $emailService = $this->get('example_app.service.sendemail.name');
        $email = "{$name}@studionone.com.au";

        $sent = $emailService->sendEmail($name, $email);

        if (false === $sent) {
            throw new \Exception('Email could not be sent.');
        }

        /**
         * @var \AppBundle\Service\NameService $nameService
         */
        return $this->render('default/email-test.html.twig', [
            'name' => $name,
            'email' => $email
        ]);

    }
}
