<?php

/**
 * Example: Get Biteral's API status and info about your request
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$status = $client->status()->get();

if ($status->availableApiVersions) {
    echo "Available api versions:\n";
    foreach ($status->availableApiVersions as $apiVersion) {
        echo "  version: ".$apiVersion->payload->version."\n";
        echo "  status: ".$apiVersion->payload->status."\n";
        echo "  isDeprecated: ".($apiVersion->payload->isDeprecated ? 'Y' : 'N')."\n";
    }
}

echo "latestStableMajorApiVersion: ".$status->latestStableMajorApiVersion."\n";
echo "requestMajorApiVersion: ".$status->requestMajorApiVersion."\n";
echo "clientId: ".$status->clientId."\n";
echo "projectId: ".$status->projectId."\n";
echo "roles: ".implode(', ', $status->roles)."\n";
echo "permissions: ".implode(', ', $status->permissions)."\n";
echo "serverTime: ".$status->serverTime->format('c')."\n";
echo "environment: ".$status->environment."\n";
