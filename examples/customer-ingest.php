<?php

/**
 * Example: Ingest one customer into a Biteral project
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Entity\Customer\CustomerGender;
use Biteral\Payload\Customer\CustomerPayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$customerPayload =
    new CustomerPayload([
        'code' => 'D314K1432',
        'country' => 'ES',
        'state' => 'Barcelona',
        'city' => 'Q11355',
        'yearBorn' => 1983,
        'gender' => CustomerGender::FEMALE,
        'metadata' => [
            'currentDiscountRate' => '10%',
            'isNew' => true
        ]
    ]);

$client->customers()->ingest($customerPayload);

echo "Customer has been ingested\n";
