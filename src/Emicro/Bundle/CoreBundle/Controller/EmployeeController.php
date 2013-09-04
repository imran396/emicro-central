<?php

namespace Emicro\Bundle\CoreBundle\Controller;

use Emicro\Bundle\CoreBundle\Entity\Employee;
use Emicro\Bundle\CoreBundle\Form\EmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    public function createAction(Request $request)
    {
        $entity  = new Employee();
        $form = $this->createForm(new EmployeeType());

        if ($request->getMethod() == 'POST') {

            $form->submit($request);

            if ($form->isValid()) {

                $this->getDoctrine()->getRepository("EmicroCoreBundle:Employee")->create($form->getData());

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your changes were saved!'
                );

                return $this->redirect($this->generateUrl('emicro_core_employees'));
            }
        }

        return $this->render('EmicroCoreBundle:Employee:create.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function editAction(Request $request, Employee $entity)
    {
        $form = $this->createForm(new EmployeeType(), $entity);

        if ($request->getMethod() == 'POST') {

            $form->submit($request);

            if ($form->isValid()) {

                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->persist($entity->getAddresses());
                $em->flush();

                $this->get('session')->getFlashBag()->add(
                    'notice',
                    'Your changes were saved!'
                );

                return $this->redirect($this->generateUrl('emicro_core_employees'));
            }
        }

        return $this->render('EmicroCoreBundle:Employee:create.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }
}