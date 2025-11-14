<?php

/**
 * Example: Ingest many customers into a Biteral project
 *
 * Ingesting big amounts of customers one by one is inefficient and slow. To solve this, instead of
 * using the `customers()->ingest` method repeatedly, use the `CustomersBatchIngestService` service
 * as shown in this example.
 *
 * `batchIngest` leverages the Biteral API's batching capabilities to ingest large numbers of
 * customers efficiently, optimizing both performance and memory usage.
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Exception\BadRequestException;
use Biteral\Entity\Customer\CustomerGender;
use Biteral\Payload\Customer\CustomerPayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

// Retrieve an array of example data for a few customers
$exampleCustomersData = getExampleCustomersData(250);

// Obtain a CustomersBatchIngestService
$customersBatchIngestService = $client->customersBatchIngest();

// Start the ingestion session
$customersBatchIngestService->startIngestionSession();

foreach ($exampleCustomersData as $customerData) {

    // Create a CustomerPayload object for this example customer
    $customerPayload =
        new CustomerPayload([
            'code' => $customerData['code'],
            'country' => $customerData['country'],
            'state' => $customerData['state'],
            'city' => $customerData['city'],
            'yearBorn' => $customerData['yearBorn'],
            'gender' => CustomerGender::FEMALE
        ]);

    // Send the customer for batch ingestion
    $customersBatchIngestService->ingest($customerPayload);
}

// Finish the ingestion session
$batchIngestResult = $customersBatchIngestService->finishIngestionSession();

echo $batchIngestResult->ingestedCustomersCount." customers ingested in ".$batchIngestResult->batchesCount." batches\n";
