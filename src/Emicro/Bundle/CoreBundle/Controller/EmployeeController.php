<?php

namespace Emicro\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
{
    public function indexAction()
    {
        $employees = $this->getDoctrine()->getRepository('EmicroCoreBundle:Employee')->getAll();

        return $this->render('EmicroCoreBundle:Employee:index.html.twig', array(
            'employees' => $employees
        ));
    }

    public function testAction()
    {
        $data = array(
            'first_name' => 'Imran',
            'last_name' => 'Rahman',
            'designation' => 'Software Engineer',
            'email' => 'imran@emicrograph.com',
            'contact_number' => '0171121212',
            'addresses' => array(
                array(
                    'street' => 'Kalyanpur',
                    'city' => 'Dhaka',
                    'state' => 'Dhaka',
                    'postal_code' => 1200,
                    'country' => 'Bangladesh',
                    'is_present' => true
                ),
                array(
                    'street' => 'Mirpur',
                    'city' => 'Dhaka',
                    'state' => 'Dhaka',
                    'postal_code' => 1205,
                    'country' => 'Bangladesh',
                    'is_present' => false
                )
            )
        );

        $this->getDoctrine()->getRepository('EmicroCoreBundle:Employee')->create($data);
        return new Response("OK");
    }
}