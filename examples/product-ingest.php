<?php

/**
 * An example on how to send one product to Biteral
 */

require __DIR__.'/../examples/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Payload\Status\ProductPayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$products =
    $client->products()->ingest(
        new ProductPayload(
        )
    );
