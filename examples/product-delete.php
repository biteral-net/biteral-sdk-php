<?php

/**
 * Example: Remove one product from a Biteral project
 */

require __DIR__.'/../examples/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Exception\NotFoundException;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);


try {
    $product = $client->products()->deleteByCode('N30122');
} catch (NotFoundException $e) {
    die("Could not find product\n");
}

echo "Product deleted\n";
