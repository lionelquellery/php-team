<?php

namespace AppBundle\Repository;

use AppBundle\AppBundle;
use AppBundle\Entity\ParisFlat;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\ParisObject;
use AppBundle\Entity\User;

class ParisObjectRepository extends EntityRepository
{



  /**
   * Get objects by schools
   *
     * @param $uai
     * @return array
     */
  public function getObjects($uai)
  {

    $em = $this->getEntityManager();


    $query = $em->createQueryBuilder()
      ->select('o')
      ->from('AppBundle:ParisObject', 'o')
      ->where('o.uai = :uai');

    $query->setParameters(array(
      'uai' => $uai
    ));

    $query = $query->getQuery()->getArrayResult();

    if (!empty($query))
    {
      return array('code' => 200, 'response' => $query);
    }
    else
    {
      return array('code' => 404, "response" => "Something went wrong");
    }

  }

  /**
   * Get one object
   *
     * @param $uai
     * @param $id
     * @return array
     */
  public function getObject($uai, $id)
  {

    $em = $this->getEntityManager();

    $query = $em->createQueryBuilder()
      ->select('o')
      ->from('AppBundle:ParisObject', 'o')
      ->where('o.uai = :uai')
      ->andWhere('o.id = :id');

    $query->setParameters(array(
      'uai' => $uai,
      'id' => $id
    ));

    $query = $query->getQuery()->getArrayResult();

    if (!empty($query))
    {
      return array('code' => 200, 'response' => $query);
    }
    else
    {
      return array('code' => 403, "response" => "not authorized");
    }


  }

  /**
   * Insert object in database
   *
     * @param $response
     * @param $uai
     * @return ParisObject
     */
  public function insertObject($response, $uai)
  {

    $em = $this->getEntityManager();

    $object = new parisObject();
    $object->setUai($uai);

    if ( isset($response['id']) && !empty($response['id']))
    {
      $object->setOwner($response['id']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : id");
    }

    if ( isset($response['name']) && !empty($response['name']))
    {
      $object->setName($response['name']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : name");
    }

    if ( isset($response['price']) && !empty($response['price']))
    {
      $object->setPrice($response['price']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : price");
    }

    if ( isset($response['description']) && !empty($response['description']))
    {
      $object->setDescription($response['description']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : description");
    }

    if ( isset($response['type']) && !empty($response['type']))
    {
      $object->setType($response['type']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : type");
    }

    if ( isset($response['thumbnail']) && !empty($response['thumbnail']))
    {
      $object->setThumbnail($response['thumbnail']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : thumbnail");
    }

    if ( isset($response['album']) && !empty($response['album']))
    {
      $object->setAlbum($response['album']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : album");
    }

    $em->persist($object);
    $em->flush();

    return array('code' => 200 , 'response' => array('Id'=> $object->getId()) );

  }


  /**
   * Edit object
   *
     * @param $response
     * @param $uai
     * @param $id
     * @return array|null
     */
  public function editObject($response, $uai, $id)
  {

    $objectBDD = $this->getObject($uai, $id);

    if ( $objectBDD['code'] == 200 )
    {

      $updatedObject = $this->updateObject($objectBDD['response'], $response);

      $em = $this->getEntityManager();

      $query = $em->createQueryBuilder()
        ->update('AppBundle:ParisObject', 'o')
        ->set('o.name', ':name')
        ->set('o.price', ':price')
        ->set('o.description', ':description')
        ->set('o.type', ':type')
        ->set('o.thumbnail', ':thumbnail')
        ->set('o.album', ':album')
        ->where('o.id = :id')
        ->setParameter('name', $updatedObject[0]['name'])
        ->setParameter('price', $updatedObject[0]['price'])
        ->setParameter('description', $updatedObject[0]['description'])
        ->setParameter('type', $updatedObject[0]['type'])
        ->setParameter('thumbnail', $updatedObject[0]['thumbnail'])
        ->setParameter('album', $updatedObject[0]['album'])
        ->setParameter('id', $id)
        ->getQuery();

      $result = $query->getArrayResult();

      if ( $result === 0 )
      {
        $result = array('code' => 200, "response" => "nothing to update");
      }
      elseif ( $result === 1 )
      {
        $result = array('code' => 200, "response" => "value(s) updated");
      }
      else
      {
        $result = array('code' => 500, "response" => "something goes wrong");
      }
      return $result;

    }
    else
    {
      return $objectBDD;
    }


  }

  /**
   * Delete object
   *
     * @param $response
     * @param $id
     * @return array|null
     */
  public function deleteObject($id, $uai)
  {
    $objectBDD = $this->getObject($uai, $id);

    if ( $objectBDD['code'] == 200 )
    {
      $em = $this->getEntityManager();
      $qb = $em->createQueryBuilder();
      $query = $qb->delete('AppBundle:ParisObject', 'o')
        ->where('o.id = :id')
        ->setParameter('id', $id)
        ->getQuery();

      $result = $query->execute();

      if ( $result === 0 )
      {
        $result = array('code' => 200, "response" => "object ".$id." deleted");
      }
      elseif ( $result === 1 )
      {
        $result = array('code' => 200, "response" => "object ".$id." deleted");
      }
      else
      {
        $result = array('code' => 500, "response" => "something goes wrong");
      }
      return $result;
    }
    else
    {
      return $objectBDD;
    }

  }

  /**
   * Updates object
   *
     * @param $objectBDD
     * @param $response
     * @return mixed
     */
  public function updateObject($objectBDD, $response)
  {


    foreach ( $response as $key => $oneResponse )
    {

      switch ($key) {
        case 'name':
          $objectBDD[0]["name"] = $oneResponse;
          break;
        case 'price':
          $objectBDD[0]["price"] = $oneResponse;
          break;
        case 'description':
          $objectBDD[0]["description"] = $oneResponse;
          break;
        case 'type':
          $objectBDD[0]["type"] = $oneResponse;
          break;
        case 'thumbnail':
          $objectBDD[0]["thumbnail"] = $oneResponse;
          break;
        case 'album':
          $objectBDD[0]["album"] = $oneResponse;
          break;
      }

    }

    return $objectBDD;

  }

}