<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParisSchoolRepository extends EntityRepository
{
  public function getLocation($location)
  {

    if(is_null($location)){
      $query = $this->getEntityManager()->createQuery('SELECT s FROM AppBundle:ParisSchool s');
    }else{
      $query = $this->getEntityManager()->createQuery('SELECT s FROM AppBundle:ParisSchool s WHERE s.cp = :loc')
        ->setParameter('loc', '750'.$location);
    }

    $school = $query->getArrayResult();

    return $school;
  }

  public function getRadius($radius)
  {
    
    if($radius != NULL)
      $distance = $radius/100000;
    else
      $distance = 0.001;

    return $distance;

  }
  
  public function getArray($parisSchool)
  {
    
    $school = array(
      'id'       => $parisSchool->getId(),
      'uai'      => $parisSchool->getUai(),
      'name'     => $parisSchool->getName(),
      'adresse'  => $parisSchool->getAdresse(),
      'cp'       => $parisSchool->getCp(),
      'lat'      => $parisSchool->getLatitude(),
      'long'     => $parisSchool->getLongitude(),
    );
    
    return $school;
    
  }

}