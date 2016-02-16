<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParisRestaurantRepository extends EntityRepository
{

  public function getPerimeter($lat, $long, $distance)
  {

    $em = $this->getEntityManager();
    
    $query = $em->createQuery('SELECT r FROM AppBundle:ParisRestaurant r 
    WHERE r.latitude < :latup 
    AND   r.latitude > :latdown
    AND   r.longitude < :longup
    AND   r.longitude > :longdown
    ');
    
    $query->setParameters(array(
      'latup'    => $lat+$distance,
      'latdown'  => $lat-$distance,
      'longup'   => $long+$distance,
      'longdown' => $long-$distance
    ));

    return $query->getArrayResult();

  }

}