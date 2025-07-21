<?php

namespace Biteral\Entity\Product;

use DateTime;
use Biteral\Entity\EntityInterface;
use Biteral\Payload\Product\ProductCategoryPayload;

/**
 * Represents a category of products
 */
class ProductCategory implements EntityInterface {
    /**
     * @var string $id The product id
     */
    public $id;

    /**
     * @var int $createdAt The timestamp this product was created at Biteral at
     */
    public $createdAt;

    /**
     * @var ?int $updatedAt The timestamp this product was updated for the last time at Biteral
     */
    public $updatedAt;

    /**
     * @var ProductCategoryPayload $payload
     */
    public $payload;

    public function __construct(
        $id,
        $createdAt,
        $updatedAt,
        $payload
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->payload = $payload;
    }

    public static function fromObject($object, $transformFromObject)
    {
        $createdAt = new DateTime($object->createdAt, new \DateTimeZone('UTC'));
        $createdAt = $createdAt->getTimestamp();

        $updatedAt = new DateTime($object->updatedAt, new \DateTimeZone('UTC'));
        $updatedAt = $updatedAt->getTimestamp();

        return
            new ProductCategory(
                $object->id,
                $createdAt,
                $updatedAt,
                $transformFromObject->payloadFromObject(ProductCategoryPayload::class, $object->payload)
            );
    }
}
