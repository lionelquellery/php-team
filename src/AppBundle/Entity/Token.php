<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Token
 *
 * @ORM\Table(name="token")
 * @ORM\Entity
 */
class Token
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
     * @var integer
     *
     * @ORM\Column(name="token", type="integer", length=10, nullable=false)
     */
  private $token;

  /**
     * @var integer
     *
     * @ORM\Column(name="user", type="integer", length=100, nullable=false)
     */
  private $user;

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
     * Set token
     *
     * @param integer $token
     * @return token
     */
  public function setToken($token)
  {
    $this->token = $token;

    return $this;
  }

  /**
     * Get token
     *
     * @return integer 
     */
  public function getToken()
  {
    return $this->token;
  }

  /**
     * Set user
     *
     * @param integer $user
     * @return User
     */
  public function setUser($user)
  {
    $this->user = $user;

    return $this;
  }

  /**
     * Get user
     *
     * @return integer 
     */
  public function geUser()
  {
    return $this->user;
  }

}
