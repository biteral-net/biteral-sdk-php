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
     * @var \DateTimeImmutable $createdAt The timestamp this product was created at Biteral at
     */
    public $createdAt;

    /**
     * @var ?\DateTimeImmutable $updatedAt The timestamp this product was updated for the last time at Biteral
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
        return
            new Brand(
                $object->id,
                new DateTime($object->createdAt, new \DateTimeZone('UTC')),
                $object->updatedAt ? new DateTime($object->updatedAt, new \DateTimeZone('UTC')) : null,
                $transformFromObject->payloadFromObject(BrandPayload::class, $object->payload)
            );
    }
}
