<?php

namespace GameLibraryBundle\Controller;

use GameLibraryBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    private function fileHandle ($file, $user) {

        $dir = $this->container->getParameter('kernel.root_dir') . '/../web/uploads/';

        if (!$file)
            return;

        $fileName = $user->getPicture();

        if (!empty($fileName) && file_exists($dir . $fileName)) {
            unlink($dir . $fileName);
        }

        $fileName = md5(uniqid()) . '.' . $file->guessExtension();
        $file->move($dir, $fileName);

        $user->setPicture($fileName);

    }

    /**
     * @Route ("/editProfile/{username}", name="editProfile")
     * @Method({"GET", "POST"})
     * @Template ("GameLibraryBundle::editProfile.html.twig")
     */

    public function editProfileAction (Request $request, User $user) {

        $oldpicture=$user->getPicture();
        $form = $this->createForm('GameLibraryBundle\Form\UserType', $user);

        $form->handleRequest($request);
        $picture=$user->getPicture();

        if ($form->isSubmitted() && $form->isValid()) {
            $this->fileHandle($picture, $user);
            if(!$user->getPicture()){
                $user->setPicture($oldpicture);
            }


               // $this->fileHandle($image, $user);
               // $user->setPicture($image);
       // }
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush($user);

            return $this->redirectToRoute('fos_user_profile_show', array('id' => $user->getId()));
        }

        return [
          'edit_form' => $form->createView(),
        ];
    }

}
