<?php

namespace Biteral\Entity\Product;

use DateTime;
use Biteral\Entity\EntityInterface;
use Biteral\Payload\Product\ProductPayload;
use Biteral\Payload\Product\ProductAttributePayload;

/**
 * Represents a product's attribute
 */
class ProductAttribute implements EntityInterface {
    /**
     * @var string $id The product id
     */
    public $id;

    /**
     * @var \DateTimeImmutable $createdAt The timestamp this product was created at Biteral at
     */
    public $createdAt;

    /**
     * @var ?\DateTimeImmutable $updatedAt The timestamp this product was updated for the last time at Biteral
     */
    public $updatedAt;

    /**
     * @var ProductAttributePayload $payload
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
        return
            new ProductAttribute(
                $object->id,
                new DateTime($object->createdAt, new \DateTimeZone('UTC')),
                $object->updatedAt ? new DateTime($object->updatedAt, new \DateTimeZone('UTC')) : null,
                $transformFromObject->payloadFromObject(ProductAttributePayload::class, $object->payload)
            );
    }
}
