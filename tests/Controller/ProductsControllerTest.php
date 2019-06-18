<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductsControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/products/monthly', [], [], ['HTTP_ACCEPT' => 'application/json']);

        // lets see if we loaded the json
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        //and make sure we have valid json
        $this->assertJson($client->getResponse()->getContent());
    }
}