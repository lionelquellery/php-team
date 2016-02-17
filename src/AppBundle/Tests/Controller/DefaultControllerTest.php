<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testIndex()
    {
        //test of all route  user (functional test)
        $yann = static::createClient();
        $yann->request('GET','/school/');
        $this->assertEquals('200',$yann->getResponse()->getStatusCode());


    }
}
