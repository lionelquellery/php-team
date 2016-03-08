<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class UserRepository extends EntityRepository
{

  /**
   *
   * Get all users registered
   *
   * @return array
   */
  public function getAllUsers()
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u');

    return array('code' => 200, 'response' => $query->getArrayResult());

  }

  /**
   *
   * Generate user who will be assigned to user
   *
   * @return string
   */
  public function editUser($response, $id)
  {

    $UserBDD = $this->getUser($id);

    if ( $UserBDD['code'] == 200 )
    {
      
      $updatedUser = $this->updateUser($UserBDD['response'], $response);

      $em = $this->getEntityManager();

      $query = $em->createQueryBuilder()
        ->update('AppBundle:User', 'f')
        ->set('f.nom', ':nom')
        ->set('f.uai', ':uai')
        ->set('f.picture', ':picture')
        ->set('f.pass', ':pass')
        ->set('f.mail', ':mail')
        ->set('f.number', ':number')
        ->where('f.id = :id')
        ->setParameter('nom', $updatedUser[0]['nom'])
        ->setParameter('uai', $updatedUser[0]['uai'])
        ->setParameter('picture', $updatedUser[0]['picture'])
        ->setParameter('pass', $updatedUser[0]['pass'])
        ->setParameter('mail', $updatedUser[0]['mail'])
        ->setParameter('number', $updatedUser[0]['number'])
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
   * Updates User
   *
     * @param $objectBDD
     * @param $response
     * @return mixed
     */
  public function updateUser($UserBDD, $response)
  {


    foreach ( $response as $key => $oneResponse )
    {

      switch ($key) {
        case 'uai':
          $UserBDD[0]["uai"] = $oneResponse;
          break;
        case 'nom':
          $UserBDD[0]["nom"] = $oneResponse;
          break;
        case 'picture':
          $UserBDD[0]["picture"] = $oneResponse;
          break;
        case 'pass':
          $UserBDD[0]["pass"] = hash('sha256', $oneResponse);
          break;
        case 'mail':
          $UserBDD[0]["mail"] = $oneResponse;
          break;
        case 'number':
          $UserBDD[0]["number"] = $oneResponse;
          break;
      }

    }

    return $UserBDD;

  }

  /**
   *
   * Init the user creation
   *
   * @param $mail
   * @param $pass
   * @return array
   */
  public function registerNewUser($response)
  {

    $em = $this->getEntityManager();

    $user = new User();

    if ( isset($response['uai']) && !empty($response['uai']))
    {
      $user->setUai($response['uai']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : uai");
    }

    if ( isset($response['nom']) && !empty($response['nom']))
    {
      $user->setNom($response['nom']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : nom");
    }

    if ( isset($response['pass']) && !empty($response['pass']))
    {
      $hashPassword = hash('sha256', $response['pass']);
      $user->setPass($hashPassword);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : pass");
    }

    if ( isset($response['mail']) && !empty($response['mail']))
    {
      $user->setMail($response['mail']);
    }
    else
    {
      return array('code' => 401, "response" => "missing value : mail");
    }

    $em->persist($user);
    $em->flush();

    return array('code' => 200 , 'response' => array('Id'=> $user->getId()) );

  }



  /**
   *
   * Delete a user
   *
   * @param $id
   * @return array
   */
  public function deleteUser($id)
  {
    $em = $this->getEntityManager();
    $query = $em
      ->createQuery('DELETE FROM AppBundle:User u WHERE u.id = :id')
      ->setParameter('id', $id);

    $result = $query->execute();

    if($result == 1)
      return array('code' => 200, 'response' => 'user '. $id .' deleted');
    else
      return array('code' => 409,'response' => 'an error occured');

  }

  /**
   *
   * Get one User
   *
   * @param $uai
   * @param $id
   * @return array
   */
  public function getUser($id)
  {

    $em = $this->getEntityManager();

    $query = $em->createQueryBuilder()
      ->select('u')
      ->from('AppBundle:User', 'u')
      ->where('u.id = :id');

    $query->setParameters(array(
      'id' => $id
    ));

    $query = $query->getQuery()->getArrayResult();

    if (!empty($query))
    {
      return array('code' => 200, 'response' => $query);
    }
    else
    {
      return array('code' => 404,"response" => "Somthing went wrong");
    }

  }
  
  /**
   *
   * Get user by school
   *
   * @param $uai
   * @return array
   */
  public function getUserByUai($uai)
  {
    
    $em = $this->getEntityManager();

    $query = $em->createQueryBuilder()
      ->select('u')
      ->from('AppBundle:User', 'u')
      ->where('u.uai = :uai');

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
      return array('code' => 404,"response" => "Somthing went wrong");
    }

  }
  
  /**
   *
   * Connect user
   *
   * @return array
   */
  public function userConnect($response)
  {
    
    $em = $this->getEntityManager();

    $hashPassword = hash('sha256', $response['pass']);
        
    $query = $em->createQueryBuilder()
      ->select('u')
      ->from('AppBundle:User', 'u')
      ->where('u.pass = :pass')
      ->andWhere('u.mail = :mail');

    $query->setParameters(array(
      'pass' => $hashPassword,
      'mail' => $response['mail']
    ));

    $query = $query->getQuery()->getArrayResult();

    if (!empty($query))
    {
      return array('code' => 200, 'response' => $query);
    }
    else
    {
      return array('code' => 404,"response" => "Somthing went wrong");
    }

  }

}