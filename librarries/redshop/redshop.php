<?php
namespace Redshop;

$client = new GuzzleHttp\Client();

$res = $client->request('GET', 'https://api.github.com/user', [
    'auth' => ['user', 'pass']
]);

echo $res->getStatusCode();