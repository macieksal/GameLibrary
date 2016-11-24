<?php

namespace GameLibraryBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="GameLibraryBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;


    /**
     * @ORM\ManyToMany(targetEntity="Game", mappedBy="categories")
     */
    protected $games;

    public function __construct() {
        $this->games = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Category
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add games
     *
     * @param \GameLibraryBundle\Entity\Game $games
     * @return Category
     */
    public function addGame(\GameLibraryBundle\Entity\Game $games)
    {
        $this->games[] = $games;
        $games->addCategory($this);

        return $this;
    }

    /**
     * Remove games
     *
     * @param \GameLibraryBundle\Entity\Game $games
     */
    public function removeGame(\GameLibraryBundle\Entity\Game $game)
    {

        $this->games->removeElement($game);
        $game->removeCategory($this);
    }

    /**
     * Get games
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGames()
    {
        return $this->games;
    }

    public function __toString()
    {
        return $this->name;
    }
}
