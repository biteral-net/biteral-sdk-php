<?php

namespace Biteral\Entity\Customer;

use DateTime;
use Biteral\Entity\EntityInterface;
use Biteral\Payload\Customer\CustomerPayload;

/**
 * Represents a product
 */
class Customer implements EntityInterface {
    /**
     * @var string $id The customer id
     */
    public $id;

    /**
     * @var int $createdAt The timestamp this customer was created at Biteral at
     */
    public $createdAt;

    /**
     * @var ?int $updatedAt The timestamp this customer was updated for the last time at Biteral
     */
    public $updatedAt;

    /**
     * @var string $projectId The Id of the project this customer belongs to
     */
    public $projectId;

    /**
     * @var CustomerPayload $payload
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
        $createdAt = new DateTime($object->createdAt, new \DateTimeZone('UTC'));
        $createdAt = $createdAt->getTimestamp();

        $updatedAt = new DateTime($object->updatedAt, new \DateTimeZone('UTC'));
        $updatedAt = $updatedAt->getTimestamp();

        return
            new Customer(
                $object->id,
                $createdAt,
                $updatedAt,
                $object->projectId,
                $transformFromObject->payloadFromObject(
                    CustomerPayload::class,
                    $object->payload
                )
            );
    }
}
