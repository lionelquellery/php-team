<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParisObjectRepository extends EntityRepository
{

    public function getObjects($uai)
    {

        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT o FROM AppBundle:ParisObject o
    WHERE o.uai < :uai
    ');

        $query->setParameters(array(
            'uai'    => $uai
        ));

        return $query->getArrayResult();

    }

}