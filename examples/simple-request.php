<?php

/**
 * Example: A simple request to first learn how the SDK works
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$status = $client->status()->get();

echo "Your client id is: ".$status->clientId."\n";
