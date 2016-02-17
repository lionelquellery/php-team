<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="userkey", type="string", length=50, nullable=false)
     */
    private $userkey;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=200, nullable=false)
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="rights", type="integer", nullable=false)
     */
    private $rights;



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
     * Set userKey
     *
     * @param string $userkey
     * @return User
     */
    public function setUserkey($userkey)
    {
        $this->userkey = $userkey;

        return $this;
    }

    /**
     * Get userkey
     *
     * @return string 
     */
    public function getUserkey()
    {
        return $this->userkey;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set rights
     *
     * @param integer $rights
     * @return User
     */
    public function setRights($rights)
    {
        $this->rights = $rights;

        return $this;
    }

    /**
     * Get rights
     *
     * @return integer 
     */
    public function getRights()
    {
        return $this->rights;
    }
}
