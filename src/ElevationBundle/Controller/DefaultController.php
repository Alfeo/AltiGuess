<?php

namespace ElevationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use ElevationBundle\Entity\Road;
use ElevationBundle\Entity\Answer;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $formFactory = $this->get('fos_user.registration.form.factory');
        $form = $formFactory->createForm();
        if ($this->has('security.csrf.token_manager')) {
            $csrfToken = $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue();
        } else {
            // BC for SF < 2.4
            $csrfToken = $this->has('form.csrf_provider')
                ? $this->get('form.csrf_provider')->generateCsrfToken('authenticate')
                : null;
        }
        return $this->render('ElevationBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
            'csrf_token' => $csrfToken,
        ));
    }

    public function gameAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->container->get('security.context')->getToken()->getUser();
        
        $round = $request->request->get('round');
        $score = $request->request->get('score');
        $thisRoad = $request->request->get('road');

        if ($score != null)
        {
            $oldReponse = $request->request->get('correct');   
            $estimation = $request->request->get('estimation');

            if ($oldReponse - $estimation >= 1000 || $estimation - $oldReponse >= 1000)
                $score = $score + 50;

            elseif ($oldReponse - $estimation >= 500 || $estimation - $oldReponse >= 500)
                $score = $score + 100;

            elseif ($oldReponse - $estimation >= 250 || $estimation - $oldReponse >= 250)
                $score = $score + 250;

            elseif ($oldReponse - $estimation >= 100 || $estimation - $oldReponse >= 100)
                $score = $score + 500;

            elseif ($oldReponse - $estimation >= 50 || $estimation - $oldReponse >= 50)
                $score = $score + 750;

            elseif ($oldReponse - $estimation >= 0 || $estimation - $oldReponse >= 0)
                $score = $score + 1000;
        }
        else
        {
            $score = 0;
        }

        if ($round == 6)
        {
            $answer = new Answer();

            $answer->setUserid($user->getId());
            $answer->setScore($score);
            $answer->setSeed($thisRoad);

            $em->persist($answer);
            $em->flush();

            $url = $this->generateUrl('user_dashboard');
            $response = new RedirectResponse($url);
            return $response;
        }

        if ($round == 0)
        {
            $compteur = 0;
            $generate = 0;

            $road = new Road();

            while($compteur < 5)
            {
                $countSpot = count($em->getRepository('ElevationBundle:Spot')->findAll());
                $idSpot = rand(1, $countSpot);

                $thisSpot = $em->getRepository('ElevationBundle:Spot')->findOneById($idSpot);
                
                if ($compteur == 0)
                    $road->setRound1($thisSpot->getId());
                elseif ($compteur == 1)
                    $road->setRound2($thisSpot->getId());
                elseif ($compteur == 2)
                    $road->setRound3($thisSpot->getId());
                elseif ($compteur == 3)
                    $road->setRound4($thisSpot->getId());
                elseif ($compteur == 4)
                    $road->setRound5($thisSpot->getId());

                $compteur++;
            }

            $seed = "";

            while($generate < 5)
            {
                $generateChiffre = rand(100, 1000);
                $seed.=$generateChiffre;
                $generate++;
            }

            $road->setSeed($seed);
            $em->persist($road);
            $em->flush();

            $thisRoad = $seed;

            $round = 1;
        }

        $theRoad = $em->getRepository('ElevationBundle:Road')->findOneBySeed($thisRoad);

        if ($round == 1)
            $theSpot = $em->getRepository('ElevationBundle:Spot')->findOneById($theRoad->getRound1());
        elseif ($round == 2)
            $theSpot = $em->getRepository('ElevationBundle:Spot')->findOneById($theRoad->getRound2());
        elseif ($round == 3)
            $theSpot = $em->getRepository('ElevationBundle:Spot')->findOneById($theRoad->getRound3());
        elseif ($round == 4)
            $theSpot = $em->getRepository('ElevationBundle:Spot')->findOneById($theRoad->getRound4());
        elseif ($round == 5)
            $theSpot = $em->getRepository('ElevationBundle:Spot')->findOneById($theRoad->getRound5());

    	$json_string = file_get_contents("https://maps.googleapis.com/maps/api/elevation/json?locations=".$theSpot->getLatitude().",".$theSpot->getLongitude()."&key=AIzaSyDkiqOX50qAPJqa8mlXw0XYK3onu3Bcda4");
        $jsonData = json_decode($json_string, true);

        $latitude = $jsonData['results'][0]['location']['lat'];
        $longitude = $jsonData['results'][0]['location']['lng'];
        $elevationRaw = $jsonData['results'][0]['elevation'];

        $elevation = round($elevationRaw, 0);
        
        return $this->render('ElevationBundle:Default:game.html.twig', array(
            'longitude' => $longitude,
            'latitude' => $latitude,
            'elevation' => $elevation,
            'round' => $round,
            'thisRoad' => $thisRoad,
            'score' => $score,
        ));
    }
}
