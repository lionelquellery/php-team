<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    /**
     *
     */
    public function testRouterSchool()
    {
        //test of all route  user (functional test)
        $yann = static::createClient();
        $yann->request('GET','/school/',array('CONTENT_TYPE'=>'application/json'));
        $this->assertEquals('200',$yann->getResponse()->getStatusCode());



    }


    public function testRouterUser()
    {
        // test for router user
        $lionel = static::createClient();
        $lionel->request('GET','/user/',array('CONTENT_TYPE'=>'application/json'));
        $this->assertEquals('200',$lionel->getResponse()->getStatusCode());
    }


    public function testRouterOther()
    {
        // test for router user
        $lionel = static::createClient();
        $crawler = $lionel->request('GET','/user/',array('CONTENT_TYPE'=>'application/json'));
        $this->assertEquals('200',$lionel->getResponse()->getStatusCode());
    }
}
