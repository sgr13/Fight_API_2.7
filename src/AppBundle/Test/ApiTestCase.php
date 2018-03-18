<?php
/**
 * Created by PhpStorm.
 * User: slawek
 * Date: 18.03.18
 * Time: 19:26
 */

namespace AppBundle\Test;

use GuzzleHttp\Client;


class ApiTestCase extends \PHPUnit_Framework_TestCase
{
    private static $staticClient;

    /**
     * @var Client
     */
    protected $client;

    //Make sure that client is created just once
    public static function setUpBeforeClass()
    {
        self::$staticClient = new Client(array(
            'base_url' => 'http://localhost:8000',
            'defaults' => array(
                'exceptions' => false,
            )
        ));
    }

    //Puts the Client onto a non static property
    public function setUp()
    {
        $this->client = self::$staticClient;
    }

}