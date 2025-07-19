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
     * @var int $createdAt The timestamp this product was created at Biteral at
     */
    public $createdAt;

    /**
     * @var ?int $updatedAt The timestamp this product was updated for the last time at Biteral
     */
    public $upatedAt;

    /**
     * @var bool $isActive Whether this product is active at Biteral
     */
    public $isActive;

    /**
     * @var string $projectId The Id of the project this product belongs to
     */
    public $projectId;

    /**
     * @var ProductPayload $data
     */
    public $data;

    public function __construct(
        $id,
        $createdAt,
        $updatedAt,
        $isActive,
        $projectId,
        $data
    )
    {
        $this->id = $id;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->isActive = $isActive;
        $this->projectId = $projectId;
        $this->data = $data;
    }

    public static function fromObject($object, $transformFromObject)
    {
        $createdAt = new DateTime($object->createdAt, new \DateTimeZone('UTC'));
        $createdAt = $createdAt->getTimestamp();

        $updatedAt = new DateTime($object->updatedAt, new \DateTimeZone('UTC'));
        $updatedAt = $updatedAt->getTimestamp();

        return
            new Product(
                $object->id,
                $createdAt,
                $updatedAt,
                $object->isActive,
                $object->projectId,
                $transformFromObject->payloadFromObject(ProductPayload::class, $object->data)
            );
    }
}
