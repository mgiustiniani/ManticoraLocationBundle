<?php

namespace Manticora\LocationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ManticoraLocationBundle:Default:index.html.twig', array('name' => $name));
    }
}
