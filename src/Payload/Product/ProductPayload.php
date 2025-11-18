<?php

namespace Biteral\Payload\Product;

use Biteral\Payload\Payload;
use Biteral\Entity\Brand\Brand;
use Biteral\Payload\Brand\BrandPayload;
use Biteral\Payload\Shared\PricePayload;
use Biteral\Entity\Product\ProductCategory;
use Biteral\Entity\Product\ProductAttribute;
use Biteral\Payload\Product\ProductCategoryPayload;
use Biteral\Payload\Product\ProductAttributePayload;

class ProductPayload extends Payload {
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
     * @var ProductAttribute[]|ProductAttributePayload[] The products' attributes, either as an array of entities or payloads
     */
    public $attributes;

    /**
     * @var Brand|BrandPayload The product brand, either as an entity or as a payload
     */
    public $brand;

    /**
     * @var ProductCategory|ProductCategoryPayload The product's category, either as an entity or as a payload
     */
    public $category;

    /**
     * @var PricePayload $price The product price
     */
    public $price;

    /**
     * @var string $imageUrl The product image URL
     */
    public $imageUrl;

    /**
     * @var string $url The public URL to the product page
     */
    public $url;

    /**
     * @var bool $isActive Whether this product is active at Biteral
     */
    public $isActive;

    /**
     * @var mixed $metadata The product metadata
     */
    public $metadata;

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ProductPayload([
                'code' => $object->code,
                'title' => $object->title,
                'description' => $object->description,
                'attributes' => $transformFromObject->entityFromObject($object->attributes),
                'brand' => $transformFromObject->entityFromObject($object->brand),
                'category' => $transformFromObject->entityFromObject($object->category),
                'price' => $transformFromObject->payloadFromObject(PricePayload::class, $object->price),
                'imageUrl' => $object->imageUrl,
                'url' => $object->url,
                'metadata' => $object->metadata,
                'isActive' => $object->isActive
            ]);
    }

}
