<?php

namespace Biteral\Entity\Status;

use Biteral\Entity\EntityInterface;
use Biteral\Payload\Status\StatusPayload;

/**
 * Represents the status of the API and the request you made
 */
class Status implements EntityInterface {
    /**
     * @var StatusPayload $data
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new Status(
                $transformFromObject->payloadFromObject(StatusPayload::class, $object->data)
            );
    }
}
