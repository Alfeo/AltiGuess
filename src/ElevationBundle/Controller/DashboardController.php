<?php

namespace ElevationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        return $this->render('ElevationBundle:Dashboard:index.html.twig', array(
            'user' => $user,
        ));
    }
}
