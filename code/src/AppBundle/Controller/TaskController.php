<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

Class TaskController extends Controller
{
    public function indexAction()
    {
        return $this->render('task/index.html.twig');
    }
}