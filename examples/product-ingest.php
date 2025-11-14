<?php

/**
 * Example: Ingest one product into a Biteral project
 */

require __DIR__.'/../examples/include/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

use Biteral\Client;
use Biteral\Payload\Brand\BrandPayload;
use Biteral\Payload\Shared\PricePayload;
use Biteral\Payload\Product\ProductPayload;
use Biteral\Payload\Product\ProductCategoryPayload;
use Biteral\Payload\Product\ProductAttributePayload;

$client = new Client($apiKey, $apiVersion, $apiBaseUrl);

$productPayload =
    new ProductPayload([
        'code' => 'N30122',
        'title' => 'Urban Sports Sneakers for Men - AirFlow Model',
        'description' => 'These sneakers combine style and comfort for everyday use. Designed with breathable materials, non-slip rubber sole, and ergonomic insole, they are ideal for both walking around the city and light indoor training. The AirFlow model offers a perfect fit and a modern design that matches any casual look. Available in various sizes and colors.',
        'attributes' => [
            new ProductAttributePayload(['title' => 'Material', 'value' => 'Leather']),
            new ProductAttributePayload(['title' => 'Color', 'value' => 'black with grey accents']),
            new ProductAttributePayload(['title' => 'Available sizes', 'value' => '39, 40, 41, 42, 43, 44']),
            new ProductAttributePayload(['title' => 'Sole', 'value' => 'non-slip rubber']),
            new ProductAttributePayload(['title' => 'Weight', 'value' => '850g (pair, size 42)']),
            new ProductAttributePayload(['title' => 'Recommended use', 'value' => 'Daily wear and light training'])
        ],
        'brand' => new BrandPayload(['code' => 'OW142302', 'name' => 'Nike']),
        'category' => new ProductCategoryPayload([
            'code' => 'MC418292',
            'title' => 'Sports Sneakers',
            'description' => 'Footwear designed to provide comfort, support, and performance for physical or athletic activities. These sneakers are also suitable for urban and everyday use thanks to their modern designs and versatile materials. They feature non-slip soles, breathable fabrics, and styles that combine functionality with fashion.'
        ]),
        'price' => new PricePayload(['amount' => '49.95', 'currency' => 'EUR']),
        'imageUrl' => 'https://m.media-amazon.com/images/I/61cELGQXXhL._AC_UL320_.jpg',
        'url' => 'https://www.amazon.es/Hitmars-Zapatillas-Deportivas-Transpirables-Sneakers/dp/B0CYGMZVL7',
        'metadata' => [
            'videoUrl' => "https://m.media-amazon.com/videos/C/dk14lkKlsnw._AC_UL1080_.mp4",
            'currentDiscountRate' => '50%',
            'isNew' => true,
            'isFeatured' => false
        ]
    ]);

$client->products()->ingest($productPayload);

echo "Product has been ingested\n";
