<?php

/**
 * Example: Get one product from a Biteral project
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Exception\NotFoundException;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

try {
    $product = $client->products()->getByCode('N30122');
} catch (NotFoundException $e) {
    die("Could not find product\n");
}

echo
    'id: '.$product->id."\n".
    'createdAt: '.$product->createdAt->format('c')."\n".
    'updatedAt: '.($updatedAt ? $product->updatedAt->format('c') : '')."\n".
    'projectId: '.$product->projectId."\n".
    'code: '.$product->payload->code."\n".
    'isActive: '.($product->payload->isActive ? 'Y' : 'N')."\n".
    'title: '.$product->payload->title."\n".
    'description: '.$product->payload->description."\n".
    (is_array($product->payload->attributes) ?
        "attributes: \n".
        implode(
            array_map(
                function ($attribute) { return '  '.$attribute->id.' > '.$attribute->payload->title.': '.$attribute->payload->value."\n"; },
                $product->payload->attributes
            )
        )
    : '').
    ($product->payload->brand ?
        'brand: '.$product->payload->brand->id.' > '.$product->payload->brand->payload->code.': '.$product->payload->brand->payload->name."\n"
    : '').
    ($product->payload->category ?
        'category: '.$product->payload->category->id.' > '.$product->payload->category->payload->code.': '.$product->payload->category->payload->title.' / '.$product->payload->category->payload->description."\n"
    : '').
    ($product->payload->price ?
        'price: '.$product->payload->price->amount.$product->payload->price->currency."\n"
    : '').
    ($product->payload->imageUrl ? 'imageUrl: '.$product->payload->imageUrl."\n" : '').
    ($product->payload->url ? 'URL: '.$product->payload->url."\n" : '').
    ($product->payload->metadata ? 'metadata: '."\n".json_encode($product->payload->metadata, JSON_PRETTY_PRINT)."\n" : '');
