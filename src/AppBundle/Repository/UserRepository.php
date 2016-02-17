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

  public function newUser($token, $mail)
  {

    $em = $this->getEntityManager();

    $query = $em
      ->createQuery('SELECT u FROM AppBundle:User u WHERE u.mail = :mail')
      ->setParameter('mail', $mail);

    if(empty($query->getResult()))
      return $this->insertNewUser($token, $mail);
    else
      return array('status' => 'user already registered');

  }

  public function insertNewUser($token, $mail)
  {

    $user = new User();
    $user->setMail($mail);
    $user->setUserkey($token);
    $user->setRights(0);

    $em = $this->getEntityManager();

    $em->persist($user);
    $em->flush();

    $this->registrationMail($token, $mail);

    return array("status" => 'User saved');

  }

  public function registerNewUser($mail)
  {

    return $this->newUser($this->generateToken(), $mail);

  }

  public function registrationMail($token, $mail)
  {

    mail($mail, 'StudentCheck Api access', 'Your api token : ', 'From: webmaster@example.com');

  }

}