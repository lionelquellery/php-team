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
     * @ORM\Column(name="uai", type="string", length=10, nullable=false)
     */
  private $uai;

  /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=100, nullable=false)
     */
  private $nom;

  /**
     * @var string
     *
     * @ORM\Column(name="picture", type="string", length=200, nullable=false)
     */
  private $picture;


  /**
     * @var string
     *
     * @ORM\Column(name="pass", type="string", length=200, nullable=false)
     */
  private $pass;

  /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=200, nullable=false)
     */
  private $mail;

  /**
     * @var string
     *
     * @ORM\Column(name="number", type="integer", nullable=false)
     */
  private $number;



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
     * Set pass
     *
     * @param string $pass
     * @return User
     */
  public function setPass($pass)
  {
    $this->pass = $pass;

    return $this;
  }

  /**
     * Get pass
     *
     * @return string 
     */
  public function getPass()
  {
    return $this->pass;
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
     * Set uai
     *
     * @param string $uai
     * @return User
     */
  public function setUai($uai)
  {
    $this->uai = $uai;

    return $this;
  }

  /**
     * Get uai
     *
     * @return string 
     */
  public function getUai()
  {
    return $this->uai;
  }

  /**
     * Set nom
     *
     * @param string $nom
     * @return User
     */
  public function setNom($nom)
  {
    $this->nom = $nom;

    return $this;
  }

  /**
     * Get nom
     *
     * @return string 
     */
  public function getNom()
  {
    return $this->nom;
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
