<?php

namespace Biteral\Entity\Status;

use Biteral\Entity\EntityInterface;
use Biteral\Payload\Status\ApiVersionPayload;

/**
 * Represents the status of the API and the request you made
 */
class ApiVersion implements EntityInterface {
    /**
     * @var ApiVersionPayload $data
     */
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ApiVersion(
                $transformFromObject->payloadFromObject(ApiVersionPayload::class, $object->data)
            );
    }
}
