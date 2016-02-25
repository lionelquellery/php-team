<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class UserRepository extends EntityRepository
{

  /**
   *
   * Verify the user permissions
   *
   * @param $key
   * @return bool
   */
  public function verifyPermission($key)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.userkey = :key')
      ->setParameter('key', $key);

    $rights = $query->getArrayResult();

    if(!empty($rights)){
      if($rights[0]['rights'] == '1')
        return true;
      else
        return false;
    }
    else
      return false;

  }

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
   * Verify key given by user
   *
   * @param $key
   * @return bool
   */
  public function verifyKey($key)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.userkey = :key ')
      ->setParameter('key', $key);

    if(empty($query->getResult()))
      return false;
    else
      return true;

  }

  /**
   *
   * Generate user who will be assigned to user
   *
   * @return string
   */
  public function generateToken()
  {

    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $token = array();
    $charactersLength = strlen($characters) - 1;

    for ($i = 0; $i < 10; $i++)
    {

      $n = rand(0, $charactersLength);
      $token[] = $characters[$n];

    }

    return implode($token);

  }

  /**
   *
   * Create a new user with his user token assigned
   *
   * @param $token
   * @param $mail
   * @param $pass
   * @return array
   */
  public function newUser($token, $mail, $pass)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.mail = :mail')
      ->setParameter('mail', $mail);

    if(empty($query->getResult()))
      return $this->insertNewUser($token, $mail, $pass);
    else
      return array('code'   => 409 ,'response' => 'user already registered');

  }

  /**
   *
   * Insert the user in the database
   *
   * @param $token
   * @param $mail
   * @param $pass
   * @return array
   */
  public function insertNewUser($token, $mail, $pass)
  {

    $hashPassword = hash('sha256',$pass);

    $user = new User();
    $user->setMail($mail);
    $user->setUserkey($token);
    $user->setRights(0);
    $user->setPass($hashPassword);

    $em = $this->getEntityManager();

    $em->persist($user);
    $em->flush();

    return array("code"   =>  200 ,"response" => 'User saved');

  }

  /**
   *
   * Init the user creation
   *
   * @param $mail
   * @param $pass
   * @return array
   */
  public function registerNewUser($mail,$pass)
  {

    if(is_null($mail) || is_null($pass))
      return array('code'   => 401 ,"response" => 'Data missing');
    else
      return $this->newUser($this->generateToken(), $mail, $pass);

  }

  /**
   *
   * Return a user's token when he given his mail and password
   *
   * @param $mail
   * @param $pass
   * @return array
   */
  public function verifyUser($mail, $pass) 
  {

    if(is_null($mail) || is_null($pass))
      return array('code'   => 401 ,"response" => 'Data missing');

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.mail = :mail')
      ->setParameter('mail', $mail);

    $user = $query->getArrayResult();

    if(hash('sha256', $pass) == $user[0]["pass"])
      return array('code' => 200, 'response' => $user[0]["userkey"]);
    else
      return array('code' => 403, 'response' => 'Not valid password');

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

}