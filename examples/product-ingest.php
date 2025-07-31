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
    new ProductPayload(
        'N30122',
        'Urban Sports Sneakers for Men - AirFlow Model',
        'These sneakers combine style and comfort for everyday use. Designed with breathable materials, non-slip rubber sole, and ergonomic insole, they are ideal for both walking around the city and light indoor training. The AirFlow model offers a perfect fit and a modern design that matches any casual look. Available in various sizes and colors.',
        [
            new ProductAttributePayload('Material', 'Leather'),
            new ProductAttributePayload('Color', 'black with grey accents'),
            new ProductAttributePayload('Available sizes', '39, 40, 41, 42, 43, 44'),
            new ProductAttributePayload('Sole', 'non-slip rubber'),
            new ProductAttributePayload('Weight', '850g (pair, size 42)'),
            new ProductAttributePayload('Recommended use', 'Daily wear and light training')
        ],
        new BrandPayload('OW142302', 'Nike'),
        new ProductCategoryPayload(
            'MC418292',
            'Sports Sneakers',
            'Footwear designed to provide comfort, support, and performance for physical or athletic activities. These sneakers are also suitable for urban and everyday use thanks to their modern designs and versatile materials. They feature non-slip soles, breathable fabrics, and styles that combine functionality with fashion.'
        ),
        new PricePayload('49.95', 'EUR'),
        'https://m.media-amazon.com/images/I/61cELGQXXhL._AC_UL320_.jpg',
        'https://www.amazon.es/Hitmars-Zapatillas-Deportivas-Transpirables-Sneakers/dp/B0CYGMZVL7',
        [
            'videoUrl' => "https://m.media-amazon.com/videos/C/dk14lkKlsnw._AC_UL1080_.mp4",
            'currentDiscountRate' => '50%',
            'isNew' => true,
            'isFeatured' => false
        ]
    );

$client->products()->ingest($productPayload);

echo "Product has been ingested\n";
