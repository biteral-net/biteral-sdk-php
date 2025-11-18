<?php

namespace Biteral\Payload\Status;

use Biteral\Payload\Payload;

class ApiVersionPayload extends Payload {
    /**
     * @var string $version The full version string
     */
    public $version;

    /**
     * @var string $status The status this version is considered in
     */
    public $status;

    /**
     * @var bool $isDeprecated Whether this version is considered to be deprecated
     */
    public $isDeprecated;

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ApiVersionPayload([
                'version' => $object->version,
                'status' => $object->status,
                'isDeprecated' => $object->isDeprecated
            ]);
    }
}
