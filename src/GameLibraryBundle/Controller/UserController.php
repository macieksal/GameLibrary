<?php

namespace GameLibraryBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Class UserController
 * @package GameLibraryBundle\Controller
 * @Route ("/user")
 */
class UserController extends Controller
{
    /**
     * @Route ("/")
     * @Template ("GameLibraryBundle::template.html.twig")
     */
    public function defaultAction () {

        dump($this->getUser());
        return [];
    }

}
