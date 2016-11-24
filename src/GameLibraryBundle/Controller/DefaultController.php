<?php

namespace GameLibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="default")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $games = $em->getRepository('GameLibraryBundle:Game')->findAll();
        return $this->render('GameLibraryBundle::template.html.twig', array (
            'games' => $games
        ));
    }


}
