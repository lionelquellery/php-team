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
            ->getRepository('AppBundle:ParisRestaurant');
    }

    public function testPerimeter(){
        $test = $this->repo->getPerimeter(48.862795000000, 2.3361960000000, 0.0001);
        $this->assertInternalType('array', $test);
    }
}