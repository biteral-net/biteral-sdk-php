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

    public function __construct($object, $transformFromObject)
    {
        $this->version = $object->version;
        $this->status = $object->status;
        $this->isDeprecated = $object->isDeprecated;
    }
}
