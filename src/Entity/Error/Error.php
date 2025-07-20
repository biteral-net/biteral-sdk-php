<?php

namespace Biteral\Entity\Error;

use Biteral\Entity\EntityInterface;
use Biteral\Payload\Error\ErrorPayload;


/**
 * Represents the status of the API and the request you made
 */
class Error implements EntityInterface {
    /**
     * @var ErrorPayload $payload
     */
    public $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new Error(
                $transformFromObject->payloadFromObject(ErrorPayload::class, $object->payload)
            );
    }
}
