<?php

/**
 * Example: Remove one customer from a Biteral project
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Exception\NotFoundException;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);


try {
    $customer = $client->customers()->deleteByCode('D314K1432');
} catch (NotFoundException $e) {
    die("Could not find customer\n");
}

echo "Customer deleted\n";
