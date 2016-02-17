<?php
namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\User;

class UserRepository extends EntityRepository
{

  public function verifyKey($key)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.userkey = :key ')
      ->setParameter('key', $key);

    if(empty($query->getResult()))
      return false;
    else
      return $query->getResult();

  }

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

  public function newUser($token, $mail, $pass)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.mail = :mail')
      ->setParameter('mail', $mail);

    if(empty($query->getResult()))
      return $this->insertNewUser($token, $mail, $pass);
    else
      return array('status' => 'user already registered');

  }

  public function insertNewUser($token, $mail, $pass)
  {

    $user = new User();
    $user->setMail($mail);
    $user->setUserkey($token);
    $user->setRights(0);
    $user->setPass($pass);

    $em = $this->getEntityManager();

    $em->persist($user);
    $em->flush();

    return array("status" => 'User saved');

  }

  public function registerNewUser($mail,$pass)
  {

    if(is_null($mail) || is_null($pass))
      return array("statut" => 'Data missing');
    else
      return $this->newUser($this->generateToken(), $mail, $pass);

  }

  public function verifyUser($mail, $pass) 
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.mail = :mail')
      ->setParameter('mail', $mail);

    $user = $query->getArrayResult();

    if($pass == $user[0]["pass"])
      return $user;
    else
      return array("statut" => 'Not valid password');

  }

}