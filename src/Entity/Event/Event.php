<?php

namespace Biteral\Entity\Event;

use DateTime;
use Biteral\Entity\EntityInterface;
use Biteral\Payload\Event\EventPayload;

/**
 * Represents an event
 */
class Event implements EntityInterface {
    /**
     * @var string $id The event id
     */
    public $id;

    /**
     * @var int $createdAt The timestamp this event was created at Biteral at
     */
    public $createdAt;

    /**
     * @var ?int $updatedAt The timestamp this event was updated for the last time at Biteral
     */
    public $updatedAt;

    /**
     * @var string $projectId The Id of the project this event belongs to
     */
    public $projectId;

    /**
     * @var EventPayload $payload
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
            new Event(
                $object->id,
                $createdAt,
                $updatedAt,
                $object->projectId,
                $transformFromObject->payloadFromObject(
                    EventPayload::class,
                    $object->payload
                )
            );
    }
}
