<?php

/**
 * Example: Ingest many products into a Biteral project
 *
 * Ingesting big amounts of products one by one is inefficient and slow. To solve this, instead of
 * using the `products()->ingest` method repeatedly, use the `ProductsBatchIngestService` service as shown
 * in this example.
 *
 * `batchIngest` leverages the Biteral API's batching capabilities to ingest large numbers of
 * products efficiently, optimizing both performance and memory usage.
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Payload\Shared\PricePayload;
use Biteral\Payload\Product\ProductPayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

// Retrieve an array of example data for a few products
$exampleProductsData = getExampleProductsData(250);

// Obtain a ProductsBatchIngestService
$productsBatchIngestService = $client->productsBatchIngest();

// Start the ingestion session
$productsBatchIngestService->startIngestionSession();

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
            null,
            null
        );

    // Send the product for batch ingestion
    $productsBatchIngestService->ingest($productPayload);
}

// Finish the ingestion session
$batchIngestResult = $productsBatchIngestService->finishIngestionSession();

echo $batchIngestResult->ingestedProductsCount." products ingested in ".$batchIngestResult->batchesCount." batches\n";
