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
//        // create entity manager mock
//        $entityManagerMock = $this->getMockBuilder('Doctrine\ORM\EntityManager')
//            ->setMethods(array('persist', 'flush'))
//            ->disableOriginalConstructor()
//            ->getMock();

       
        // next you need inject your mocked em into client's service container
        $client = static::createClient();
//        $client->getContainer()->set('doctrine.orm.default_entity_manager', $entityManagerMock);

        $crawler = $client->request('GET', '/api/products/1');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

}
