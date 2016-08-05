<?php

namespace ElevationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ElevationBundle\Entity\Answer;

class DashboardController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();

        $allAnswers = $em->getRepository('ElevationBundle:Answer')->findByUserid($user->getId());

        return $this->render('ElevationBundle:Dashboard:index.html.twig', array(
            'user' => $user,
            'allAnswers' => $allAnswers
        ));
    }
}
