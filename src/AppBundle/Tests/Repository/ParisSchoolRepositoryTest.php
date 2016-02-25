<?php

namespace AppBundle\Tests\Repository;

use AppBundle\Entity\ParisSchool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParisSchoolRepositoryTest extends WebTestCase
{
    private $repo;

    protected function setUp()
    {
        self::bootKernel();

        $this->repo = static::$kernel->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:ParisSchool');
    }

    public function testgetRadius()
    {
        $radiusRatio = $this->repo->getRadius(9);
        $this->assertInternalType("float", $radiusRatio);

    }

    public function testgetLocation()
    {
        $arrayu = $this->repo->getLocation(05);
        $this->assertInternalType("array",$arrayu);


    }

    public function testgetByUai()
    {
        $trust = $this->repo->getByUai("0750728J");


    }







}