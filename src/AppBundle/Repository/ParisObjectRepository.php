<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ParisObjectRepository extends EntityRepository
{

    /**
     * @param $uai
     * @return array
     */
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

    /**
     * @param $id
     * @return array
     */
    public function getObject($id)
    {

        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT o FROM AppBundle:ParisObject o
    WHERE o.id = :id
    ');

        $query->setParameters(array(
            'id'    => $id
        ));

        return $query->getArrayResult();

    }

}