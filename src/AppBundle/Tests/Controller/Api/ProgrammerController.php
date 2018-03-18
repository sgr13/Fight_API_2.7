<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 18.03.18
 * Time: 17:26
 */

namespace AppBundle\Tests\Controller\Api;


use AppBundle\Test\ApiTestCase;

class ProgrammerController extends ApiTestCase
{
    public function setup()
    {
        parent::setup();

        $this->createUser('weaverryan');
    }

    public function testPOST()
    {


        $data = array(
            'nickname' => 'ObjectOrienter',
            'avatarNumber' => 5,
            'tagLine' => 'a test dev!'
        );

//1. POST to create the programmer

        $response = $this->client->post('/api/programmers', array(
            'body' => json_encode($data)
        ));

        $this->assertEquals(201, $response->getStatusCode());
        $this->assertEquals('/api/programmers/ObjectOrienter', $response->getHeader('Location'));
        $finishedData = json_decode($response->getBody(), true);
        $this->assertArrayHasKey('nickname', $finishedData);
        $this->assertEquals('ObjectOrienter', $data['nickname']);

    }
}