<?php

namespace Biteral\Entity\Error;

use Biteral\Entity\EntityInterface;
use Biteral\Payload\Error\ErrorPayload;


/**
 * Represents the status of the API and the request you made
 */
class Error implements EntityInterface {
    /**
     * @var ErrorPayload $data
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new Error(
                $transformFromObject->payloadFromObject(ErrorPayload::class, $object->data)
            );
    }
}
