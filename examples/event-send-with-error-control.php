<?php

/**
 * Example: Send an event into a Biteral project
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Payload\Event\EventPayload;
use Biteral\Exception\BadRequestException;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$eventPayload =
    new EventPayload([
        'type' => 'EventSale',
        'timestamp' => new DateTimeImmutable('2025-11-15 15:53:15'),
        'customerCode' => 'D314K1432',
        'productCode' => 'N30122'
    ]);

try {

    $client->events()->ingest($eventPayload);
    echo "Event has been ingested\n";

} catch (BadRequestException $e) {

    echo
        "Errors found when ingesting\n".
        $e->getFieldErrorsHumanized();

}
