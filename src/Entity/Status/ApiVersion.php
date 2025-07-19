<?php

namespace Biteral\Entity\Status;

use Biteral\Entity\Entity;
use Biteral\Payload\Status\ApiVersionPayload;

/**
 * Represents the status of the API and the request you made
 */
class ApiVersion extends Entity {
    /**
     * @var ApiVersionPayload $data
     */
    public $data;

    public function __construct($object, $transformFromObject)
    {
        $this->data = $transformFromObject->payloadFromObject(ApiVersionPayload::class, $object->data);
    }
}
