<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Mails;

class MailsRepository extends EntityRepository
{

  function inserMail($mailToInsert)
  {

    $em = $this->getEntityManager();

    $mail = new Mails();
    $mail->setMail($mailToInsert);

    $em->persist($mail);
    $em->flush();

    return array('code' => 200, 'response' => 'Mail inserted');

  }

}