# Biteral PHP SDK

Easily integrate [Biteral](https://biteral.net) AI tools into your e-commerce platform.

🔎 Natural language product search
🧠 AI-powered product recommendations
🏷️ Customer tagging and segmentation
📊 Real-time trend recommendations

SDK usage guides and API documentation 👉 https://docs.biteral.net

---

[![Packagist](https://img.shields.io/packagist/v/biteral/biteral-sdk-php.svg)](https://packagist.org/packages/biteral/biteral-sdk-php)
[![PHP Version](https://img.shields.io/packagist/php-v/biteral/biteral-sdk-php.svg)](https://packagist.org/packages/biteral/biteral-sdk-php)

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

require 'vendor/autoload.php';

$client = new Client('your-biteral-api-key');

$product = $client->products()->post(
    new ProductPayload(
        code: 'N39291',
        title: 'Men’s Urban Sports Sneakers – AirFlow Model',
        description: 'These sneakers combine style and comfort for everyday use. Designed with breathable materials, non-slip rubber soles, and ergonomic insoles, they are ideal for both walking around the city and indoor training. The AirFlow model offers a perfect fit and a modern design that suits any casual look. Available in various sizes and colors.',
        price: new PricePayload(45.95, Currency::EURO),
        attributes: [
            new ProductAttributePayload('Material', 'leather'),
            new ProductAttributePayload('Color', 'black with grey accents'),
            new ProductAttributePayload('Available Sizes', '39, 40, 41, 42, 43, 44'),
            new ProductAttributePayload('Sole', 'non-slip rubber'),
            new ProductAttributePayload('Weight', '850g (pair, size 42)'),
            new ProductAttributePayload('Recommended Use', 'Everyday wear and light training')
        ],
        brand: new ProductBrandPayload('OW142398', 'Nike'),
        category: new ProductCategoryPayload('MC418298', 'Sports Sneakers')
    )
);

echo $product->id;
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
