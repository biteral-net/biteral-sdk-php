<?php

/**
 * Example: Ingest one product into a Biteral project with detailed error control
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Payload\Shared\PricePayload;
use Biteral\Exception\BadRequestException;
use Biteral\Payload\Product\ProductPayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$productPayload =
    new ProductPayload([
        'code' => 'N30412',
        'title' => 'Urban Sports Sneakers for Men - AirFlow Model',
        'price' => new PricePayload(['amount' => '49.95', 'currency' => 'XCD']), // This causes an error: XCD is not a valid currency
    ]);

try {

    $client->products()->ingest($productPayload);
    echo "Product has been ingested\n";

} catch (BadRequestException $e) {

    echo
        "Errors found when ingesting\n".
        $e->getFieldErrorsHumanized();

}
