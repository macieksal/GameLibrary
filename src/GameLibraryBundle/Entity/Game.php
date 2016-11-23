<?php

namespace GameLibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Game
 *
 * @ORM\Table(name="game")
 * @ORM\Entity(repositoryClass="GameLibraryBundle\Repository\GameRepository")
 */
class Game
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     * @Assert\NotBlank(message="Game title cannot be blank")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="producer", type="string", length=255)
     */
    private $producer;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="premiere_date", type="date")
     */
    private $premiereDate;

    /**
     * @var \integer
     *
     * @ORM\Column(name="rating", type="integer", nullable=true)
     */
    private $rating;


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
     * Set title
     *
     * @param string $title
     * @return Game
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set producer
     *
     * @param string $producer
     * @return Game
     */
    public function setProducer($producer)
    {
        $this->producer = $producer;

        return $this;
    }

    /**
     * Get producer
     *
     * @return string 
     */
    public function getProducer()
    {
        return $this->producer;
    }

    /**
     * Set premiereDate
     *
     * @param \DateTime $premiereDate
     * @return Game
     */
    public function setPremiereDate($premiereDate)
    {
        $this->premiereDate = $premiereDate;

        return $this;
    }

    /**
     * Get premiereDate
     *
     * @return \DateTime 
     */
    public function getPremiereDate()
    {
        return $this->premiereDate;
    }

    /**
     * Set rating
     *
     * @param integer $rating
     * @return Game
     */
    public function setRating($rating)
    {
        $this->rating = $rating;

        return $this;
    }

    /**
     * Get rating
     *
     * @return integer 
     */
    public function getRating()
    {
        return $this->rating;
    }
}
