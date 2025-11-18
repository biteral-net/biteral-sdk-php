<?php

/**
 * Example: Ingest one customer into a Biteral project with detailed error control
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Exception\BadRequestException;
use Biteral\Entity\Customer\CustomerGender;
use Biteral\Payload\Customer\CustomerPayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$customerPayload =
    new CustomerPayload([
        'code' => 'D314K1432',
        'country' => 'United', // This causes an error, 'United' can refer to more than one country
        'state' => 'Granada', // This causes an error, 'Granada' can refer to more than one state
        'city' => 'Paris', // This causes an error: 'Paris' can refer to more than one city
        'yearBorn' => 1983,
        'gender' => CustomerGender::FEMALE,
        'metadata' => [
            'currentDiscountRate' => '10%',
            'isNew' => true
        ]
    ]);

try {

    $client->customers()->ingest($customerPayload);
    echo "Customer has been ingested\n";

} catch (BadRequestException $e) {

    echo
        "Errors found when ingesting\n".
        $e->getFieldErrorsHumanized();

}
