<?php 

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\ParisFlat;

class ParisFlatRepository extends EntityRepository
{

  /**
   * @param $uai
   * @param null $userkey
   * @return array
   */
  public function getFlats($uai, $userkey)
  {

    $em = $this->getEntityManager();

    $hasRight = $this->getUser($userkey);

    if (!empty($hasRight))
    {

      if($hasRight[0]['rights'] === 1)
      {
        $query = $em->createQueryBuilder()
          ->select('f')
          ->from('AppBundle:ParisFlat', 'f')
          ->where('f.uai = :uai');

        $query->setParameters(array(
          'uai' => $uai
        ));
      }
      else
      {
        $query = $em->createQueryBuilder()
          ->select('f')
          ->from('AppBundle:ParisFlat', 'f')
          ->where('f.uai = :uai')
          ->andWhere('f.owner = :userkey');

        $query->setParameters(array(
          'uai' => $uai,
          'userkey' => $userkey
        ));
      }

      $query = $query->getQuery()->getArrayResult();

      if (!empty($query))
      {
        return array('code' => 200, 'response' => $query);
      }
      else
      {
        return array('code' => 404, "response" => "Something goes wrong, maybe you havn't objects yet ?");
      }

    }
    else
    {
      return array('code' => 403,"response" => "wrong userkey");
    }

  }

  /**
   * @param $uai
   * @param $id
   * @param $userkey
   * @return array
   */
  public function getFlat($uai, $id, $userkey)
  {

    $em = $this->getEntityManager();
    $hasRight = $this->getUser($userkey);

    if (!empty($hasRight))
    {


      if($hasRight[0]['rights'] === 1)
      {

        $query = $em->createQueryBuilder()
          ->select('f')
          ->from('AppBundle:ParisFlat', 'f')
          ->where('f.uai = :uai')
          ->andWhere('f.id = :id');

        $query->setParameters(array(
          'uai' => $uai,
          'id' => $id
        ));

      }
      else
      {
        $query = $em->createQueryBuilder()
          ->select('f')
          ->from('AppBundle:ParisFlat', 'f')
          ->where('f.uai = :uai')
          ->andWhere('f.id = :id')
          ->andWhere('f.owner = :userkey');

        $query->setParameters(array(
          'uai' => $uai,
          'id' => $id,
          'userkey' => $userkey
        ));

      }

      $query = $query->getQuery()->getArrayResult();

      if (!empty($query))
      {
        return array('code' => 200, 'response' => $query);
      }
      else
      {
        return array('code' => 401,"response" => "not authorized");
      }

    }
    else
    {
      return array('code' => 401,"response" => "wrong userkey");
    }


  }

  /**
   * @param $response
   * @param $uai
   * @return ParisFlat
   */
  public function insertFlat($response, $key, $uai)
  {

    $hasRight = $this->getUser($key);

    if (!empty($hasRight))
    {

      $em = $this->getEntityManager();

      $flat = new ParisFlat();
      $flat->setUai($uai);
      $flat->setOwner($key);

      if ( isset($response['name']) && !empty($response['name']))
      {
        $flat->setName($response['name']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : name");
      }

      if ( isset($response['price']) && !empty($response['price']))
      {
        $flat->setPrice($response['price']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : price");
      }

      if ( isset($response['description']) && !empty($response['description']))
      {
        $flat->setDescription($response['description']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : description");
      }

      if ( isset($response['type']) && !empty($response['type']))
      {
        $flat->setType($response['type']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : type");
      }

      if ( isset($response['thumbnail']) && !empty($response['thumbnail']))
      {
        $flat->setThumbnail($response['thumbnail']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : thumbnail");
      }

      if ( isset($response['album']) && !empty($response['album']))
      {
        $flat->setAlbum($response['album']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : album");
      }

      if ( isset($response['longitude']) && !empty($response['longitude']))
      {
        $flat->setLongitude($response['longitude']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : longitude");
      }

      if ( isset($response['latitude']) && !empty($response['latitude']))
      {
        $flat->setLatitude($response['latitude']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : latitude");
      }

      if ( isset($response['date']) && !empty($response['date']))
      {
        $flat->setDate($response['date']);
      }
      else
      {
        return array('code' => 401,"response" => "missing value : date");
      }


      $em->persist($flat);
      $em->flush();

      return array('code' => 200, 'response' => array('Id'=> $flat->getId() ));

    }
    else
    {
      return array('code' => 403,"response" => "wrong userkey");
    }
  }


  /**
   * @param $response
   * @param $uai
   * @param $id
   * @return array|null
   */
  public function editFlat($response, $key, $uai, $id)
  {

    $flatBDD = $this->getFlat($uai, $id, $key);

    if ( $flatBDD['code'] == 200 )
    {

      $updatedFlat = $this->updateFlat($flatBDD['response'], $response);

      $em = $this->getEntityManager();

      $query = $em->createQueryBuilder()
        ->update('AppBundle:ParisFlat', 'f')
        ->set('f.name', ':name')
        ->set('f.price', ':price')
        ->set('f.description', ':description')
        ->set('f.type', ':type')
        ->set('f.thumbnail', ':thumbnail')
        ->set('f.album', ':album')
        ->set('f.longitude', ':longitude')
        ->set('f.latitude', ':latitude')
        ->set('f.date', ':date')
        ->where('f.id = :id')
        ->setParameter('name', $updatedFlat[0]['name'])
        ->setParameter('price', $updatedFlat[0]['price'])
        ->setParameter('description', $updatedFlat[0]['description'])
        ->setParameter('type', $updatedFlat[0]['type'])
        ->setParameter('thumbnail', $updatedFlat[0]['thumbnail'])
        ->setParameter('album', $updatedFlat[0]['album'])
        ->setParameter('longitude', $updatedFlat[0]['longitude'])
        ->setParameter('latitude', $updatedFlat[0]['latitude'])
        ->setParameter('date', $updatedFlat[0]['date'])
        ->setParameter('id', $id)
        ->getQuery();

      $result = $query->getArrayResult();

      if ( $result === 0 )
      {
        $result = array('code' => 200, "response" => "nothing to update");
      }
      elseif ( $result === 1 )
      {
        $result = array('code' => 200,"response" => "value(s) updated");
      }
      else
      {
        $result = array('code' => 500,"response" => "something goes wrong");
      }
      return $result;

    }
    else
    {
      return $flatBDD;
    }


  }

  /**
   * @param $response
   * @param $id
   * @return array|null
   */
  public function deleteFlat($key, $id, $uai)
  {
    $flatBDD = $this->getFlat($uai, $id, $key);

    if ( $flatBDD['code'] == 200 )
    {
      $em = $this->getEntityManager();
      $qb = $em->createQueryBuilder();
      $query = $qb->delete('AppBundle:ParisFlat', 'f')
        ->where('f.id = :id')
        ->setParameter('id', $id)
        ->getQuery();

      $result = $query->execute();

      if ( $result === 0 )
      {
        $result = array('code' => 200,"response" => "flat ".$id." deleted");
      }
      elseif ( $result === 1 )
      {
        $result = array('code' => 200,"response" => "flat ".$id." deleted");
      }
      else
      {
        $result = array('code' => 500,"response" => "something goes wrong");
      }
      return $result;
    }
    else
    {
      return $objectBDD;
    }

  }

  /**
   * @param $flatBDD
   * @param $response
   * @return mixed
   */
  public function updateFlat($flatBDD, $response)
  {

    foreach ( $response as $key => $oneResponse )
    {

      switch ($key) {
        case 'name':
          $flatBDD[0]["name"] = $oneResponse;
          break;
        case 'type':
          $flatBDD[0]["type"] = $oneResponse;
          break;
        case 'album':
          $flatBDD[0]["album"] = $oneResponse;
          break;
        case 'longitude':
          $flatBDD[0]["longitude"] = $oneResponse;
          break;
        case 'latitude':
          $flatBDD[0]["latitude"] = $oneResponse;
          break;
        case 'thumbnail':
          $flatBDD[0]["thumbnail"] = $oneResponse;
          break;
        case 'date':
          $flatBDD[0]["date"] = $oneResponse;
          break;
        case 'price':
          $flatBDD[0]["price"] = $oneResponse;
          break;
        case 'description':
          $flatBDD[0]["description"] = $oneResponse;
          break;
      }

    }

    return $flatBDD;

  }

  /**
   * @param $userkey
   * @return array
   */
  public function getUser($userkey)
  {
    $em = $this->getEntityManager();

    $query = $em->createQuery('SELECT u FROM AppBundle:User u
    WHERE u.userkey = :userkey
    ');

    $query->setParameters(array(
      'userkey' => $userkey
    ));

    return $query->getArrayResult();
  }

  /**
   * @param $userkey
   * @param $flatBDD
   * @return bool|null
   */
  public function checkUserRights($userkey, $flatBDD)
  {

    // If object owner is the good one
    if ( $flatBDD === $userkey )
    {

      return true;

    }
    else
    {
      // Checking if the action is done by an admin
      $admin = $this->getUser($userkey);

      if (is_null($admin) || empty($admin))
      {
        return null;
      }
      elseif ($admin[0]['rights'] === 0)
      {
        return null;
      }
      else
      {
        return true;
      }

    }



  }

}