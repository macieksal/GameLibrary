<?php

namespace GameLibraryBundle\Controller;

use GameLibraryBundle\Entity\Game;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Game controller.
 *
 * @Route("game")
 */
class GameController extends Controller
{
    /**
     * Lists all game entities.
     *
     * @Route("/", name="game_index")
     * @Method("GET")
     * @Template ("GameLibraryBundle:game:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $games = $em->getRepository('GameLibraryBundle:Game')->findAll();

        return array(
            'games' => $games,
        );
    }

    /**
     * Creates a new game entity.
     *
     * @Route("/new", name="game_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        if ($this->getUser() != null) {
            $game = new Game();
            $form = $this->createForm('GameLibraryBundle\Form\GameType', $game);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->persist($game);
                $em->flush($game);

                return $this->redirectToRoute('game_show', array('id' => $game->getId()));
            }

            return $this->render('GameLibraryBundle:game:new.html.twig', array(
                'game' => $game,
                'form' => $form->createView(),
            ));
        }

        return new Response('<html><head><title>Access denied</title></head><body>You must be logged to add a new game to the library.</body>');
    }

    /**
     * Finds and displays a game entity.
     *
     * @Route("/{id}", name="game_show")
     * @Method("GET")
     * @Template ("GameLibraryBundle:game:show.html.twig")
     */
    public function showAction(Game $game)
    {
        $deleteForm = $this->createDeleteForm($game);

        return array(
            'game' => $game,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Creates a form to delete a game entity.
     *
     * @param Game $game The game entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Game $game)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('game_delete', array('id' => $game->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * Displays a form to edit an existing game entity.
     *
     * @Route("/{id}/edit", name="game_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Game $game)
    {
        if ($this->getUser() != null) {
            $deleteForm = $this->createDeleteForm($game);
            $editForm = $this->createForm('GameLibraryBundle\Form\GameType', $game);
            $editForm->handleRequest($request);

            if ($editForm->isSubmitted() && $editForm->isValid()) {
                $this->getDoctrine()->getManager()->flush();

                return $this->redirectToRoute('game_edit', array('id' => $game->getId()));
            }

            return $this->render('game/edit.html.twig', array(
                'game' => $game,
                'edit_form' => $editForm->createView(),
                'delete_form' => $deleteForm->createView(),
            ));
        }

        return new Response('<html><head><title>Access denied</title></head><body>You must be logged to edit game.</body>');


    }

    /**
     * Deletes a game entity.
     *
     * @Route("/{id}", name="game_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Game $game)
    {
        if ($this->getUser() != null) {
            $form = $this->createDeleteForm($game);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $em->remove($game);
                $em->flush($game);
            }

            return $this->redirectToRoute('game_index');
        }
        return new Response('<html><head><title>Access denied</title></head><body>You must be logged in order to delete game.</body>');
    }

    /**
     * @Route ("/rate")
     * @Method ("POST")
     */

    public function rateAction(Request $request)
    {

        $rating = $request->request->get('rating');
        $id = $request->request->get('id');

        $repository = $this->getDoctrine()->getRepository('GameLibraryBundle:Game');
        $game = $repository->find($id);

        if ($game) {

            $game->setRatingQuantity($game->getRatingQuantity() + 1);
            $game->setRatingSum(($game->getRatingSum() + $rating));
            $game->setRating(($game->getRatingSum()) / ($game->getRatingQuantity()));

        }

        $em = $this->getDoctrine()->getManager();

        $em->flush();


        $newGameRating =$game->getRating();


        $array = array(
            'rating' => $newGameRating,
            'votes' => $game->getRatingQuantity(),
            'id' => $game->getId()
        );

        return new JsonResponse($array);

    }
}
