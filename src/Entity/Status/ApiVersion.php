<?php

namespace Biteral\Entity\Status;

use Biteral\Entity\EntityInterface;
use Biteral\Payload\Status\ApiVersionPayload;

/**
 * Represents the status of the API and the request you made
 */
class ApiVersion implements EntityInterface {
    /**
     * @var ApiVersionPayload $payload
     */
    public $payload;

    public function __construct($payload)
    {
        $this->payload = $payload;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ApiVersion(
                $transformFromObject->payloadFromObject(ApiVersionPayload::class, $object->payload)
            );
    }
}
