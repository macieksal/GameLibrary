<?php

namespace GameLibraryBundle\Entity;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;


    /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=255)
     *
     * @Assert\File(mimeTypes={"image/jpeg"})
     */
<<<<<<< HEAD


=======
>>>>>>> d15aaa7e94a2ff60410248749f055a36753d4166
    private $picture = 'uploads/defaultAvatar.jpg';

    public function __construct()
    {
        parent::__construct();

    }

    /**
     * Set description
     *
     * @param string $description
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set picture
     *
     * @param string $picture
     * @return User
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string 
     */
    public function getPicture()
    {
        return $this->picture;
    }
}
