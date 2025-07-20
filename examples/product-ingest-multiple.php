<?php

/**
 * Example: Ingest multiple products into a Biteral project
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Payload\Shared\PricePayload;
use Biteral\Payload\Product\ProductPayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

// Retrieve an array of example products data
$exampleProductsData = include(__DIR__.'/../examples/include/example_products_data.php');

$count = 0;
$productPayloads = []; // Prepare an array to contain all ProductPayload objects
foreach ($exampleProductsData as $productData) {

    // Create a ProductPayload object for this example product
    $productPayload =
        new ProductPayload(
            $productData['code'],
            $productData['title'],
            null,
            null,
            null,
            null,
            new PricePayload($productData['price_amount'], $productData['price_currency']),
            $productData['image_url'],
            null
        );

    // Add the ProductPayload to the array
    $productPayloads[] = $productPayload;

    $count ++;

    // Consider only the first 250 example products
    if ($count === 250) {
        break;
    }
}

// Call `ingest` passing the array of ProductPayload objects instead of a single ProductPayload
$ingestResult = $client->products()->ingest($productPayloads);

echo $ingestResult->ingestedProductsCount." products ingested in ".$ingestResult->batchesCount." batches\n";
