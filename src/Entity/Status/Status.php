<?php

namespace Biteral\Entity\Status;

use Biteral\Entity\Entity;
use Biteral\Payload\Status\StatusPayload;

/**
 * Represents the status of the API and the request you made
 */
class Status extends Entity {
    /**
     * @var StatusPayload $data
     */
    public $data;

    public function __construct($object, $transformFromObject)
    {
        $this->data = $transformFromObject->payloadFromObject(StatusPayload::class, $object->data);
    }
}
