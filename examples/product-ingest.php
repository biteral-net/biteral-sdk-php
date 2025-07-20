<?php

/**
 * An example on how to send one product to Biteral
 */

require __DIR__.'/../examples/bootstrap.php'; // Don't use this in your code, it's here just to make runing examples easier

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
        'Zapatillas deportivas urbanas para hombre – modelo AirFlow',
        'Estas zapatillas combinan estilo y comodidad para el uso diario. Diseñadas con materiales transpirables, suela de goma antideslizante y plantilla ergonómica, son ideales tanto para caminar por la ciudad como para entrenar en interiores. El modelo AirFlow ofrece un ajuste perfecto y un diseño moderno que se adapta a cualquier look casual. Disponibles en varias tallas y colores.',
        [
            new ProductAttributePayload('Material', 'Cuero'),
            new ProductAttributePayload('Color', 'negro con detalles en gris'),
            new ProductAttributePayload('Tallas disponibles', '39, 40, 41, 42, 43, 44'),
            new ProductAttributePayload('Suela', 'goma antideslizante'),
            new ProductAttributePayload('Peso', '850g (par, talla 42)'),
            new ProductAttributePayload('Uso recomendado', 'Uso diario y entrenamiento ligero')
        ],
        new BrandPayload('OW142302', 'Nike'),
        new ProductCategoryPayload(
            'MC418292',
            'Zapatillas deportivas',
            'Calzado diseñado para ofrecer comodidad, soporte y rendimiento en actividades físicas o deportivas. Estas zapatillas también se adaptan al uso urbano y diario gracias a sus diseños modernos y materiales versátiles. Incluyen características como suelas antideslizantes, tejidos transpirables y estilos que combinan funcionalidad con moda.'
        ),
        new PricePayload('49.95', 'EUR'),
        'https://m.media-amazon.com/images/I/61cELGQXXhL._AC_UL320_.jpg',
        [
            'videoUrl' => "https://m.media-amazon.com/videos/C/dk14lkKlsnw._AC_UL1080_.mp4",
            'currentDiscountRate' => '50%',
            'isNew' => true,
            'isFeatured' => false
        ]
    );

$client->products()->ingest($productPayload);
