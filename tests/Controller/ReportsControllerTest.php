<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ReportsControllerTest extends WebTestCase
{
    public function testShowPost()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reports/sales');

        // lets see if we loaded the page
        $this->assertEquals(200, $client->getResponse()->getStatusCode());

        // and make sure our chart divs are actualy there
        $this->assertEquals(
            1,
            $crawler->filter('#quantity-container')->count()
        );
        $this->assertEquals(
            1,
            $crawler->filter('#price-container')->count()
        );

    }
}