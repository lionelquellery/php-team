<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParisRestaurant
 *
 * @ORM\Table(name="paris_restaurant")
 * @ORM\Entity
 */
class ParisRestaurant
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
     * @ORM\Column(name="category", type="string", length=55, nullable=true)
     */
    private $category;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=98, nullable=true)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="latitude", type="decimal", precision=14, scale=12, nullable=true)
     */
    private $latitude;

    /**
     * @var string
     *
     * @ORM\Column(name="longitude", type="decimal", precision=14, scale=13, nullable=true)
     */
    private $longitude;

    /**
     * @var string
     *
     * @ORM\Column(name="originalId", type="string", length=51, nullable=true)
     */
    private $originalid;

    /**
     * @var string
     *
     * @ORM\Column(name="polarity", type="string", length=60, nullable=true)
     */
    private $polarity;



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
     * Set category
     *
     * @param string $category
     * @return ParisRestaurant
     */
    public function setCategory($category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return ParisRestaurant
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set latitude
     *
     * @param string $latitude
     * @return ParisRestaurant
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return string 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param string $longitude
     * @return ParisRestaurant
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return string 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set originalid
     *
     * @param string $originalid
     * @return ParisRestaurant
     */
    public function setOriginalid($originalid)
    {
        $this->originalid = $originalid;

        return $this;
    }

    /**
     * Get originalid
     *
     * @return string 
     */
    public function getOriginalid()
    {
        return $this->originalid;
    }

    /**
     * Set polarity
     *
     * @param string $polarity
     * @return ParisRestaurant
     */
    public function setPolarity($polarity)
    {
        $this->polarity = $polarity;

        return $this;
    }

    /**
     * Get polarity
     *
     * @return string 
     */
    public function getPolarity()
    {
        return $this->polarity;
    }
}
