<?php

require  __DIR__ . '/vendor/autoload.php';

$client = new \GuzzleHttp\Client(array(
   'base_url' => 'http://localhost:8000',
    'defaults' => array(
        'exceptions' => false,
    )
));
//
$nickname = 'ObjectOrienter' . rand(0,999);
$data = array(
    'nickname' => $nickname,
    'avatarNumber' => 5,
    'tagLine' => 'a test dev!'
);

//1. POST to create the programmer

$response = $client->post('/api/programmers', array(
    'body' => json_encode($data)
));

echo $response;
echo "\n\n";
die;

$programmerUrl = $response->getHeader('Location');


//2. GET to fetch the programmer

$response = $client->get($programmerUrl);

//3 GET a collection

$response = $client->get('/api/programmers'
);


echo $response;
echo "\n\n";