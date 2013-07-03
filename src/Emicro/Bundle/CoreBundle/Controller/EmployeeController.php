<?php

namespace Emicro\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmployeeController extends Controller
{
    public function indexAction()
    {
        $employees = $this->getDoctrine()->getRepository('EmicroCoreBundle:Employee')->getAll();

        return $this->render('EmicroCoreBundle:Employee:index.html.twig', array(
            'employees' => $employees
        ));
    }
}