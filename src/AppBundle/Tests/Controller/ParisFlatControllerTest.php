<?php

namespace AppBundle\Tests\Controller;

use AppBundle\Controller\ParisFlatController;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ParisFlatControllerTest extends WebTestCase
{


    public function testController()
    {

        $client = static::createClient();
        $crawler = $client->request('GET', '/school/0750728J/flat/?key=123',array('CONTENT_TYPE'=>'application/json'));
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /parisflat/");


    }

    public function testcontain()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/school/?key=123',array('CONTENT_TYPE'=>'application/json'));
        $this->assertContainsOnly('string', array('id'));
        $this->assertContainsOnly('string',array('longitude','response','latitude','name','uai'));

    }





    /*
    public function testCompleteScenario()
    {
        // Create a new client to browse the application
        $client = static::createClient();

        // Create a new entry in the database
        $crawler = $client->request('GET', '/parisflat/');
        $this->assertEquals(200, $client->getResponse()->getStatusCode(), "Unexpected HTTP status code for GET /parisflat/");
        $crawler = $client->click($crawler->selectLink('Create a new entry')->link());

        // Fill in the form and submit it
        $form = $crawler->selectButton('Create')->form(array(
            'appbundle_parisflat[field_name]'  => 'Test',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check data in the show view
        $this->assertGreaterThan(0, $crawler->filter('td:contains("Test")')->count(), 'Missing element td:contains("Test")');

        // Edit the entity
        $crawler = $client->click($crawler->selectLink('Edit')->link());

        $form = $crawler->selectButton('Update')->form(array(
            'appbundle_parisflat[field_name]'  => 'Foo',
            // ... other fields to fill
        ));

        $client->submit($form);
        $crawler = $client->followRedirect();

        // Check the element contains an attribute with value equals "Foo"
        $this->assertGreaterThan(0, $crawler->filter('[value="Foo"]')->count(), 'Missing element [value="Foo"]');

        // Delete the entity
        $client->submit($crawler->selectButton('Delete')->form());
        $crawler = $client->followRedirect();

        // Check the entity has been delete on the list
        $this->assertNotRegExp('/Foo/', $client->getResponse()->getContent());
    }

    */
}
