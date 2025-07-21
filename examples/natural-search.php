<?php

/**
 * Example: Perform a natural search query
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Service\NaturalSearch\NaturalSearchQuery;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$query = 'Un regalo para alguien a quien le encanta cocinar';
$limit = 5;

echo "Performing natural search query \"$query\" for $limit products ...\n";

$products =
    $client->naturalSearch()->query(
        new NaturalSearchQuery(
            $query,
            $limit
        )
    );

if (!$products) {
    echo "No matching products found\n";
} else {

    echo "\n";
    $number = 1;
    foreach ($products as $product) {
        echo "  #$number - ".$product->payload->title."\n\n";
        $number ++;
    }

}
