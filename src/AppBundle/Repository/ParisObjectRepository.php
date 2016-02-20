<?php

namespace AppBundle\Repository;

use AppBundle\AppBundle;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\ParisObject;
use AppBundle\Entity\User;

class ParisObjectRepository extends EntityRepository
{

    /**
     * @param $uai
     * @param null $userkey
     * @return array
     */
    public function getObjects($uai, $userkey)
    {

        $em = $this->getEntityManager();

        $hasRight = $this->getUser($userkey);

        if (!empty($hasRight))
        {

            if($hasRight[0]['rights'] === 1)
            {
                $query = $em->createQueryBuilder()
                    ->select('o')
                    ->from('AppBundle:ParisObject', 'o')
                    ->where('o.uai = :uai');

                $query->setParameters(array(
                    'uai' => $uai
                ));
            }
            else
            {
                $query = $em->createQueryBuilder()
                    ->select('o')
                    ->from('AppBundle:ParisObject', 'o')
                    ->where('o.uai = :uai')
                    ->andWhere('o.owner = :userkey');

                $query->setParameters(array(
                    'uai' => $uai,
                    'userkey' => $userkey
                ));
            }

            $query = $query->getQuery()->getArrayResult();

            if (!empty($query))
            {
                return $query;
            }
            else
            {
                return array("error" => "Something goes wrong, maybe you havn't objects yet ?");
            }

        }
        else
        {
            return array("error" => "wrong userkey");
        }

    }

    /**
     * @param $uai
     * @param $id
     * @param $userkey
     * @return array
     */
    public function getObject($uai, $id, $userkey)
    {

        $em = $this->getEntityManager();
        $hasRight = $this->getUser($userkey);

        if (!empty($hasRight))
        {


            if($hasRight[0]['rights'] === 1)
            {

                $query = $em->createQueryBuilder()
                    ->select('o')
                    ->from('AppBundle:ParisObject', 'o')
                    ->where('o.uai = :uai')
                    ->andWhere('o.id = :id');

                $query->setParameters(array(
                    'uai' => $uai,
                    'id' => $id
                ));

            }
            else
            {
                $query = $em->createQueryBuilder()
                    ->select('o')
                    ->from('AppBundle:ParisObject', 'o')
                    ->where('o.uai = :uai')
                    ->andWhere('o.id = :id')
                    ->andWhere('o.owner = :userkey');

                $query->setParameters(array(
                    'uai' => $uai,
                    'id' => $id,
                    'userkey' => $userkey
                ));

            }

            $query = $query->getQuery()->getArrayResult();

            if (!empty($query))
            {
                return $query;
            }
            else
            {
                return array("error" => "not authorized");
            }

        }
        else
        {
            return array("error" => "wrong userkey");
        }


    }

    /**
     * @param $response
     * @param $uai
     * @return ParisObject
     */
    public function insertObject($response, $uai)
    {

        $hasRight = $this->getUser($response['userkey']);

        if (!empty($hasRight))
        {

            $em = $this->getEntityManager();

            $object = new parisObject();
            $object->setUai($uai);
            $object->setOwner($response['userkey']);

            if ( isset($response['name']) && !empty($response['name']))
            {
                $object->setName($response['name']);
            }
            else
            {
                return array("error" => "missing value : name");
            }

            if ( isset($response['price']) && !empty($response['price']))
            {
                $object->setPrice($response['price']);
            }
            else
            {
                return array("error" => "missing value : price");
            }

            if ( isset($response['description']) && !empty($response['description']))
            {
                $object->setDescription($response['description']);
            }
            else
            {
                return array("error" => "missing value : description");
            }

            if ( isset($response['type']) && !empty($response['type']))
            {
                $object->setType($response['type']);
            }
            else
            {
                return array("error" => "missing value : type");
            }

            if ( isset($response['thumbnail']) && !empty($response['thumbnail']))
            {
                $object->setThumbnail($response['thumbnail']);
            }
            else
            {
                return array("error" => "missing value : thumbnail");
            }

            if ( isset($response['album']) && !empty($response['album']))
            {
                $object->setAlbum($response['album']);
            }
            else
            {
                return array("error" => "missing value : album");
            }

            $em->persist($object);
            $em->flush();

            return array('Id'=> $object->getId() );

        }
        else
        {
            return array("error" => "wrong userkey");
        }
    }


    /**
     * @param $response
     * @param $uai
     * @param $id
     * @return array|null
     */
    public function editObject($response, $uai, $id)
    {

        $objectBDD = $this->getObject($uai, $id);

        $updatedObject = $this->updateObject($objectBDD, $response);

        $hasRights = $this->checkRights($response['owner'], $objectBDD[0]['owner']);

        if( !is_null($hasRights) )
        {

        $em = $this->getEntityManager();

        $query = $em->createQueryBuilder()
            ->update('AppBundle:ParisObject', 'o')
            ->set('o.uai', ':uai')
            ->set('o.name', ':name')
            ->set('o.price', ':price')
            ->set('o.description', ':description')
            ->set('o.type', ':type')
            ->set('o.thumbnail', ':thumbnail')
            ->set('o.album', ':album')
            ->where('o.id = :id')
            ->setParameter('uai', $updatedObject[0]['uai'])
            ->setParameter('name', $updatedObject[0]['name'])
            ->setParameter('price', $updatedObject[0]['price'])
            ->setParameter('description', $updatedObject[0]['description'])
            ->setParameter('type', $updatedObject[0]['type'])
            ->setParameter('thumbnail', $updatedObject[0]['thumbnail'])
            ->setParameter('album', $updatedObject[0]['album'])
            ->setParameter('id', $updatedObject[0]['id'])
            ->getQuery();

            $result = $query->getResult();
            return $result;

        }
        else
        {
            return null;
        }


    }

    /**
     * @param $response
     * @param $id
     * @return array|null
     */
    public function deleteObject($response, $id, $uai)
    {
        $objectBDD = $this->getObject($uai, $id);

        $hasRights = $this->checkRights($response['owner'], $objectBDD[0]['owner']);

        if( !is_null($hasRights) )
        {
            $em = $this->getEntityManager();
            $qb = $em->createQueryBuilder();
            $query = $qb->delete('AppBundle:ParisObject', 'o')
                ->where('o.id = :id')
                ->setParameter('id', $id)
                ->getQuery();

            $query->execute();

            return $query->getArrayResult();
        }
        else
        {
            return null;
        }
    }

    /**
     * @param $objectBDD
     * @param $response
     * @return mixed
     */
    public function updateObject($objectBDD, $response)
    {

        foreach ( $response as $key => $oneResponse )
        {

            switch ($key) {
                case 'uai':
                    $objectBDD[0]["uai"] = $oneResponse;
                    break;
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
     * @param $objectBDD
     * @return bool|null
     */
    public function checkRights($userkey, $objectBDD)
    {

        // If object owner is the good one
        if ( $objectBDD === $userkey )
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