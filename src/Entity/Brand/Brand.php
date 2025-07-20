<?php

namespace Biteral\Entity\Brand;

use DateTime;
use Biteral\Entity\EntityInterface;
use Biteral\Payload\Brand\BrandPayload;

/**
 * Represents a brand
 */
class Brand implements EntityInterface {
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
     * @var BrandPayload $payload
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
            new Brand(
                $object->id,
                $createdAt,
                $updatedAt,
                $transformFromObject->payloadFromObject(BrandPayload::class, $object->payload)
            );
    }
}
