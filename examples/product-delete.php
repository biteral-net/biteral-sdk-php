<?php

/**
 * An example on how to delete one product at Biteral
 */

require __DIR__.'/../examples/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$product = $client->products()->deleteByCode('N30122');

echo "Product deleted\n";
