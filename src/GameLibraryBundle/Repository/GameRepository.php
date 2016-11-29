<?php

namespace GameLibraryBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * GameRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GameRepository extends EntityRepository
{

    public function sortByRatingFromHighest () {

        $em = $this->getEntityManager();

        $query = $em -> createQuery("SELECT game FROM GameLibraryBundle:Game game ORDER BY game.rating DESC");

        $games = $query -> getResult();

        return $games;
    }

    public function sortByRatingFromLowest () {

        $em = $this->getEntityManager();

        $query = $em -> createQuery("SELECT game FROM GameLibraryBundle:Game game ORDER BY game.rating");

        $games = $query -> getResult();

        return $games;
    }

    public function sortByPremiereDate () {

        $em = $this->getEntityManager();

        $query = $em -> createQuery("SELECT game FROM GameLibraryBundle:Game game ORDER BY game.premiereDate");

        $games = $query -> getResult();

        return $games;
    }

    public function sortByTitle () {

        $em = $this->getEntityManager();

        $query = $em -> createQuery("SELECT game FROM GameLibraryBundle:Game game ORDER BY game.title");

        $games = $query -> getResult();

        return $games;
    }

    public function sortByTimeAdded () {

        $em = $this->getEntityManager();

        $query = $em -> createQuery("SELECT game FROM GameLibraryBundle:Game game ORDER BY game.id");

        $games = $query -> getResult();

        return $games;
    }

<<<<<<< HEAD
=======
    public function Search ($string) {

        $em = $this->getEntityManager();

        $query = $em -> createQuery("SELECT game FROM GameLibraryBundle:Game game WHERE game.title LIKE :like")
            ->setParameter('like', "%$string%");

        $games = $query -> getResult();

        return $games;
    }

>>>>>>> d15aaa7e94a2ff60410248749f055a36753d4166
}
