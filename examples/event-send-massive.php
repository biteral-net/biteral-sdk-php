<?php

/**
 * Example: Send many events into a Biteral project
 *
 * Sending big amounts of events one by one is inefficient and slow. To solve this, instead of
 * using the `events()->ingest` method repeatedly, use the `EventsBatchIngestService` service
 * as shown in this example.
 *
 * `batchIngest` leverages the Biteral API's batching capabilities to ingest large numbers of
 * events efficiently, optimizing both performance and memory usage.
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Payload\Event\EventPayload;
use Biteral\Exception\BadRequestException;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

// Retrieve an array of random example events
$exampleEventsData = getExampleEventsData(250);

// Obtain an EventsBatchIngestService
$eventsBatchIngestService = $client->eventsBatchIngest();

// Start the ingestion session
$eventsBatchIngestService->startIngestionSession();

try {

    foreach ($exampleEventsData as $eventData) {

        // Create an EventPayload object for this example event
        $eventPayload =
            new EventPayload([
                'type' => $eventData['type'],
                'timestamp' => $eventData['timestamp'],
                'customerCode' => $eventData['customerCode'],
                'productCode' => $eventData['productCode']
            ]);

        // Send the event for batch ingestion
        $eventsBatchIngestService->ingest($eventPayload);
    }

    // Finish the ingestion session
    $batchIngestResult = $eventsBatchIngestService->finishIngestionSession();

} catch (BadRequestException $e) {

    echo
        "Errors found when ingesting\n".
        $e->getFieldErrorsHumanized();

}

echo $batchIngestResult->ingestedEventsCount." events ingested in ".$batchIngestResult->batchesCount." batches\n";
