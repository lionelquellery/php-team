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
     * @ORM\Column(name="id", type="integer", nullable=false)
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
     * @ORM\Column(name="lat", type="string", length=10, nullable=true)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(name="lng", type="string", length=5, nullable=true)
     */
    private $lng;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="decimal", precision=14, scale=12, nullable=true)
     */
    private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="decimal", precision=14, scale=13, nullable=true)
     */
    private $name;

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
     * @var integer
     *
     * @ORM\Column(name="subCategory", type="integer", nullable=true)
     */
    private $subcategory;

    /**
     * @var integer
     *
     * @ORM\Column(name="details", type="integer", nullable=true)
     */
    private $details;

    /**
     * @var integer
     *
     * @ORM\Column(name="reviews", type="integer", nullable=true)
     */
    private $reviews;



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
     * Set lat
     *
     * @param string $lat
     * @return ParisRestaurant
     */
    public function setLat($lat)
    {
        $this->lat = $lat;

        return $this;
    }

    /**
     * Get lat
     *
     * @return string 
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * Set lng
     *
     * @param string $lng
     * @return ParisRestaurant
     */
    public function setLng($lng)
    {
        $this->lng = $lng;

        return $this;
    }

    /**
     * Get lng
     *
     * @return string 
     */
    public function getLng()
    {
        return $this->lng;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return ParisRestaurant
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return ParisRestaurant
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

    /**
     * Set subcategory
     *
     * @param integer $subcategory
     * @return ParisRestaurant
     */
    public function setSubcategory($subcategory)
    {
        $this->subcategory = $subcategory;

        return $this;
    }

    /**
     * Get subcategory
     *
     * @return integer 
     */
    public function getSubcategory()
    {
        return $this->subcategory;
    }

    /**
     * Set details
     *
     * @param integer $details
     * @return ParisRestaurant
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return integer 
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set reviews
     *
     * @param integer $reviews
     * @return ParisRestaurant
     */
    public function setReviews($reviews)
    {
        $this->reviews = $reviews;

        return $this;
    }

    /**
     * Get reviews
     *
     * @return integer 
     */
    public function getReviews()
    {
        return $this->reviews;
    }
}
