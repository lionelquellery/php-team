<?php

namespace AppBundle\Tests\Repository;

use AppBundle\Entity\ParisRestaurant;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParisRestaurantRepositoryTest extends WebTestCase
{
    private $repo;

    protected function setUp()
    {
        self::bootKernel();

        $this->repo = static::$kernel->getContainer()
            ->get('doctrine.orm.entity_manager')
            ->getRepository('AppBundle:ParisSchool');
    }

    public function testgetPerimeter()
    {
        $long = null;
        $lat = null;
        $distance = null;

        $perimeter = $this->repo->getPerimeter($lat, $long, $distance);

    }

}