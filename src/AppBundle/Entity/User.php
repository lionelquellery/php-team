<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=200, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="school", type="string", length=8, nullable=false)
     */
    private $school;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=200, nullable=false)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="rights", type="integer", nullable=false)
     */
    private $rights;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=200, nullable=false)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="flats", type="text", length=65535, nullable=false)
     */
    private $flats;

    /**
     * @var string
     *
     * @ORM\Column(name="objects", type="text", length=65535, nullable=false)
     */
    private $objects;



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
     * @return User
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
     * Set school
     *
     * @param string $school
     * @return User
     */
    public function setSchool($school)
    {
        $this->school = $school;

        return $this;
    }

    /**
     * Get school
     *
     * @return string 
     */
    public function getSchool()
    {
        return $this->school;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
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

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set flats
     *
     * @param string $flats
     * @return User
     */
    public function setFlats($flats)
    {
        $this->flats = $flats;

        return $this;
    }

    /**
     * Get flats
     *
     * @return string 
     */
    public function getFlats()
    {
        return $this->flats;
    }

    /**
     * Set objects
     *
     * @param string $objects
     * @return User
     */
    public function setObjects($objects)
    {
        $this->objects = $objects;

        return $this;
    }

    /**
     * Get objects
     *
     * @return string 
     */
    public function getObjects()
    {
        return $this->objects;
    }
}
