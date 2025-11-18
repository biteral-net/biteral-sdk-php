<?php

$apiKey = getenv('BITERAL_API_KEY') !== false ? getenv('BITERAL_API_KEY') : (isset($_ENV['BITERAL_API_KEY']) ? $_ENV['BITERAL_API_KEY'] : null);
$apiBaseUrl = getenv('BITERAL_API_BASE_URL') !== false ? getenv('BITERAL_API_BASE_URL') : (isset($_ENV['BITERAL_API_BASE_URL']) ? $_ENV['BITERAL_API_BASE_URL'] : 'https://api.biteral.net');
$apiVersion = getenv('BITERAL_API_VERSION') !== false ? getenv('BITERAL_API_VERSION') : (isset($_ENV['BITERAL_API_VERSION']) ? $_ENV['BITERAL_API_VERSION'] : '1');

require __DIR__.'/../../vendor/autoload.php';

set_time_limit(0);

function getExampleProductsData($limit = null)
{
    $exampleProductsData = include(__DIR__.'/../../examples/include/example_products_data.php');
    return $limit && $limit < sizeof($exampleProductsData) ? array_slice($exampleProductsData, 0, $limit) : $exampleProductsData;
}

function getExampleCustomersData($limit = null)
{
    $exampleCustomersData = include(__DIR__.'/../../examples/include/example_customers_data.php');
    return $limit && $limit < sizeof($exampleCustomersData) ? array_slice($exampleCustomersData, 0, $limit) : $exampleCustomersData;
}
