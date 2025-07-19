<?php

/**
 * An example on how to get one product to Biteral
 */

require __DIR__.'/../examples/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$product = $client->products()->getByCode('B00YUU43VS');

var_dump($product);
