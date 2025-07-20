<?php

/**
 * Example: Get one product from a Biteral project
 */

require __DIR__.'/../examples/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Exception\NotFoundException;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

try {
    $product = $client->products()->getByCode('N30122');
} catch (NotFoundException $e) {
    die("Could not find product\n");
}

$createdAt = new \DateTime('@'.$product->createdAt, new \DateTimeZone('UTC'));

if ($product->updatedAt) {
    $updatedAt = new \DateTime('@'.$product->updatedAt, new \DateTimeZone('UTC'));
}

echo
    'id: '.$product->id."\n".
    'createdAt: '.$createdAt->format('c')."\n".
    ($updatedAt ? 'updatedAt: '.$updatedAt->format('c')."\n" : '').
    'isActive: '.($product->isActive ? 'Y' : 'N')."\n".
    'projectId: '.$product->projectId."\n".
    'code: '.$product->data->code."\n".
    'title: '.$product->data->title."\n".
    'description: '.$product->data->description."\n".
    (is_array($product->data->attributes) ?
        "attributes: \n".
        implode(
            array_map(
                function ($attribute) { return '  '.$attribute->id.' > '.$attribute->data->title.': '.$attribute->data->value."\n"; },
                $product->data->attributes
            )
        )
    : '').
    ($product->data->brand ?
        'brand: '.$product->data->brand->id.' > '.$product->data->brand->data->code.': '.$product->data->brand->data->name."\n"
    : '').
    ($product->data->category ?
        'category: '.$product->data->category->id.' > '.$product->data->category->data->code.': '.$product->data->category->data->title.' / '.$product->data->category->data->description."\n"
    : '').
    ($product->data->price ?
        'price: '.$product->data->price->amount.$product->data->price->currency."\n"
    : '').
    ($product->data->imageUrl ? 'imageUrl: '.$product->data->imageUrl."\n" : '').
    ($product->data->metadata ? 'metadata: '."\n".json_encode($product->data->metadata, JSON_PRETTY_PRINT)."\n" : '');
