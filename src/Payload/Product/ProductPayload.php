<?php

namespace Biteral\Payload\Product;

use Biteral\Payload\PayloadInterface;
use Biteral\Payload\Shared\PricePayload;
use Biteral\Payload\Product\BrandPayload;
use Biteral\Payload\Product\ProductCategoryPayload;
use Biteral\Payload\Product\ProductAttributePayload;

class ProductPayload implements PayloadInterface {
    /**
     * @var string $code The product code as stored in your system.
     */
    public $code;

    /**
     * @var string $title The product title.
     */
    public $title;

    /**
     * @var string $description The product description.
     */
    public $description;

    /**
     * @var PricePayload $price The product price.
     */
    public $price;

    /**
     * @var
     */
    public $attributes;

    public function __construct(
        $code,
        $title,
        $description,
        $price,
        $attributes,
        $brand,
        $category,
        $imageUrl,
        $metadata
    )
    {
        $this->code = $code;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->attributes = $attributes;
        $this->brand = $brand;
        $this->category = $category;
        $this->imageUrl = $imageUrl;
        $this->metadata = $metadata;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ProductPayload(
                $object->code,
                $object->title,
                $object->description,
                $transformFromObject->payloadFromObject(PricePayload::class, $object->price),
                $transformFromObject->entityFromObject($object->attributes),
                $transformFromObject->entityFromObject($object->brand),
                $transformFromObject->entityFromObject($object->category),
                $object->imageUrl,
                $object->metadata
            );
    }
}
