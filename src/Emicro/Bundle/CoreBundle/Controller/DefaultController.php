<?php

namespace Emicro\Bundle\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name, $id)
    {
        return $this->render('EmicroCoreBundle:Default:index.html.twig', array(
            'name' => $name,
            'id' => $id
        ));
    }
}
