<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParisFlatRepository extends EntityRepository
{

  public function getFlatsByUai($uai)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT f FROM AppBundle:ParisFlat f WHERE f.uai = :uai')
      ->setParameter('uai', $uai);

    return $query->getResult();

  }

  public function getFlatbyId($id)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT f FROM AppBundle:ParisFlat f WHERE f.id = :id')
      ->setParameter('id', $id);

    return $query->getResult();

  }

}