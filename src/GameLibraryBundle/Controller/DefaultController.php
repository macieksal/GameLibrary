<?php

namespace GameLibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
<<<<<<< HEAD
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


=======
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('GameLibraryBundle::template.html.twig');
    }
>>>>>>> d15aaa7e94a2ff60410248749f055a36753d4166
}
