# Biteral PHP SDK

[![Packagist](https://img.shields.io/packagist/v/biteral/biteral-sdk-php.svg)](https://packagist.org/packages/biteral/biteral-sdk-php)
[![PHP Version](https://img.shields.io/packagist/php-v/biteral/biteral-sdk-php.svg)](https://packagist.org/packages/biteral/biteral-sdk-php)

Easily integrate [Biteral](https://biteral.net) AI tools into your e-commerce platform.

- 🔎 Natural language product search
- 🧠 AI-powered product recommendations
- 🏷️ Customer tagging and segmentation
- 📊 Real-time trend recommendations

SDK usage guides and API documentation 👉 https://docs.biteral.net

---

## Requirements

- PHP 5.6 or higher
- [Composer](https://getcomposer.org)
- Bash, for running examples

## Installation

```bash
composer require biteral/biteral-sdk-php
```

## Usage

```php
use Biteral\Client;

$client = new Client('your-biteral-api-key');

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
```

👉 [Get a free Biteral API key](https://biteral.net) for testing your integration

## Running examples

There are usage example files in the `examples` directory you can use to learn how the SDK works through working examples.

You can run the examples using the provided `bin/example` script, like this:

```bash
bin/example <example name>
```

To get a list of available examples, run `bin/example` without any parameters.

You might need to set execution permissions for this script with `chmod +x bin/example`
