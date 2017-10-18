<?php

namespace MapsBundle\Tests\Controller;

use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ShowMapsControllerTest extends WebTestCase
{
    public function testShow()
    {
        $this->assertTrue(true);
    }


    public function test2Show()
    {

        $client = static::createClient();

        $crawler = $client->request('GET', '/all', ['CONTENT_TYPE'          => 'application/json']);

        $this->assertEquals(
            200, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode());
        $this->assertTrue(
            $client->getResponse()->headers->contains(
                'Content-Type',
                'application/json'
            ),
            'the "Content-Type" header is "application/json"' // optional message shown on failure
        );

    }


    public function test_removeShow()
    {

        $client = static::createClient();

        $client->request('POST', '/remove', array('id' => '999'));

        $this->assertContains('error', $client->getResponse()->getContent());

    }

    public function test_addShow()
    {

        $client = static::createClient();

        $client->request('POST', '/save', array('name' => 'ok', 'lat' => 'zle', 'lng' => 'zle'));

        $this->assertEquals(
            500, // or Symfony\Component\HttpFoundation\Response::HTTP_OK
            $client->getResponse()->getStatusCode()
        );

    }

}
