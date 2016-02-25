<?php

namespace AppBundle\Tests\Repository;

use AppBundle\Entity\ParisObject;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParisObjectRepositoryTest extends WebTestCase
{
    private $repo;

    protected function setUp()
    {
        self::bootKernel();

        $this->repo = static::$kernel->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:ParisObject');
    }


    public function testgetObjects(){
        $this->repo->getObjects("075728J",123);


    }

    public function testgetObject()
    {
        $this->repo->getObject("0750728J",1,123);

    }

    public function testinsertObject()
    {
        $this->repo->insertObject(100,"0750728J",123);

    }
}