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
     * @return array
     */
    public function getObjects($uai)
    {

        $em = $this->getEntityManager();

        $query = $em->createQuery('SELECT o FROM AppBundle:ParisObject o
    WHERE o.uai = :uai
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

    public function insertObject($response, $uai)
    {

        $object = new parisObject();
        $object->setUai($uai)
            ->setName($response['name'])
            ->setPrice($response['price'])
            ->setDescription($response['description'])
            ->setType($response['type'])
            ->setThumbnail($response['thumbnail'])
            ->setAlbum($response['album'])
            ->setOwner($response['owner']);

        return $object;
    }

    public function editObject($response, $uai, $id)
    {

        $objectBDD = $this->getObject($id);

        $updatedObject = $this->updateObject($objectBDD, $response);

        $hasRights = $this->checkRights($response['owner'], $objectBDD);

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

    public function getAdmin($userkey)
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

    public function checkRights($userkey, $objectBDD)
    {

        // If object owner is the good one
        if ( $objectBDD[0]["owner"] === $userkey )
        {

            return true;

        }
        else
        {
            // Checking if the action is done by an admin
            $admin = $this->getAdmin($userkey);

            if (is_null($admin) || empty($admin))
            {
                return array("error" => "Wrong user id");
            }
            elseif ($admin[0]['rights'] === 0)
            {
                return array("error" => "No rights");
            }
            else
            {
                return true;
            }

        }



    }

}