<?php

/**
 * Example: Get Biteral's API status and info about your request
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$status = $client->status()->get();

if ($status->data->availableApiVersions) {
    echo "Available api versions:\n";
    foreach ($status->data->availableApiVersions as $apiVersion) {
        echo "  version: ".$apiVersion->data->version."\n";
        echo "  status: ".$apiVersion->data->status."\n";
        echo "  isDeprecated: ".($apiVersion->data->isDeprecated ? 'Y' : 'N')."\n";
    }
}

echo "latestStableMajorApiVersion: ".$status->data->latestStableMajorApiVersion."\n";
echo "requestMajorApiVersion: ".$status->data->requestMajorApiVersion."\n";
echo "clientId: ".$status->data->clientId."\n";
echo "projectId: ".$status->data->projectId."\n";
echo "roles: ".implode(', ', $status->data->roles)."\n";
echo "permissions: ".implode(', ', $status->data->permissions)."\n";

$serverTime = new \DateTime('@'.$status->data->serverTime, new \DateTimeZone('UTC'));
echo "serverTime: ".$serverTime->format('c')."\n";

echo "environment: ".$status->data->environment."\n";
