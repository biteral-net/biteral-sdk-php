<?php

/**
 * Example: Get one customer from a Biteral project
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Exception\NotFoundException;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

try {
    $customer = $client->customers()->getByCode('D314K1432');
} catch (NotFoundException $e) {
    die("Could not find customer\n");
}

echo
    'id: '.$customer->id."\n".
    'createdAt: '.$customer->createdAt->format('c')."\n".
    'updatedAt: '.($updatedAt ? $customer->updatedAt->format('c') : '')."\n".
    'projectId: '.$customer->projectId."\n".
    'code: '.$customer->payload->code."\n".
    'isActive: '.($customer->payload->isActive ? 'Y' : 'N')."\n".
    'country: '.$customer->payload->country."\n".
    'state: '.$customer->payload->state."\n".
    'city: '.$customer->payload->city."\n".
    'yearBorn: '.$customer->payload->yearBorn."\n".
    'gender: '.$customer->payload->gender."\n".
    ($customer->payload->metadata ? 'metadata: '."\n".json_encode($customer->payload->metadata, JSON_PRETTY_PRINT)."\n" : '');
