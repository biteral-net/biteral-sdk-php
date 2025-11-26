<?php

namespace Biteral\Entity\Product;

use DateTime;
use Biteral\Entity\EntityInterface;
use Biteral\Payload\Product\ProductPayload;

/**
 * Represents a product
 */
class Product implements EntityInterface {
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
     * @var string $projectId The Id of the project this product belongs to
     */
    public $projectId;

    /**
     * @var ProductPayload $payload
     */
    public $payload;

    public function __construct(
        $id,
        $createdAt,
        $updatedAt,
        $projectId,
        $payload
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->projectId = $projectId;
        $this->payload = $payload;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new Product(
                $object->id,
                new DateTime($object->createdAt, new \DateTimeZone('UTC')),
                $object->updatedAt ? new DateTime($object->updatedAt, new \DateTimeZone('UTC')) : null,
                $object->projectId,
                $transformFromObject->payloadFromObject(ProductPayload::class, $object->payload)
            );
    }
}
