<?php

namespace Tests\AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductRESTControllerTest extends WebTestCase
{
    public function testGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/products/1');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testCGet()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/api/products');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
    
    public function testPost()
    {
        $client = static::createClient();

        $crawler = $client->request('POST', '/api/products', ["name" => "test"]);

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
    
    public function testPut()
    {
        $client = static::createClient();

        $crawler = $client->request('PUT', '/api/products/1', ["name" => "test"]);

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
    
    public function testDelete()
    {
        $client = static::createClient();

        $crawler = $client->request('DELETE', '/api/products/1');

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }

}
