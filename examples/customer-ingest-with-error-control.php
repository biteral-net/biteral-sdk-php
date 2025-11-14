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
        'country' => 'United',
        'state' => 'Granada',
        'city' => 'Paris',
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

    echo "Errors found when ingesting\n";

    if ($e->isFieldErrors()) {
        foreach ($e->getFieldErrors() as $fieldError) {
            echo
                "Field: ".$fieldError['field']."\n".
                "Code: ".$fieldError['code']."\n".
                "Description: ".$fieldError['description']."\n".
                "\n";
        }
    }

}
