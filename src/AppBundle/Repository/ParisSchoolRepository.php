<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParisSchoolRepository extends EntityRepository
{

  /**
   *
   * Return school by zip code. Return all of param empty
   *
   * @param $location
   * @return array
   */
  public function search($string = null)
  {

    if(is_null($string))
      return array('code' => 404, 'response' => 'No data passed');
    else{

      $em = $this->getEntityManager();

      $query = $em
      ->createQuery('SELECT s FROM AppBundle:ParisSchool s WHERE s.name LIKE :name OR s.sigle LIKE :name')
      ->setParameter('name', $string.'%');

      $schools = $query->getArrayResult();

      return  array('code' => 200, 'response' => $schools);

    }

  }

  /**
   *
   * Convert metric param to GPS values
   *
   * @param $radius
   * @return float
   */
  public function getRadius($radius)
  {

    if($radius != NULL)
      $distance = $radius/100000;
    else
      $distance = 0.001;

    return $distance;

  }

  /**
   *
   * Get school data
   *
   * @param $parisSchool
   * @return array
   */
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

  /**
   *
   * Get school by Uai
   *
   * @param $uai
   * @return array
   */
  public function getByUai($uai, $array = null)
  {

    $em = $this->getEntityManager();

    $query = $em
    ->createQuery('SELECT s FROM AppBundle:ParisSchool s WHERE s.uai = :uai')
    ->setParameter('uai', $uai);

    if(is_null($array))
      return $query->getResult();
    else
      return $query->getArrayResult();
    
  }

}