<?php

namespace Biteral\Payload\Status;

use Biteral\Payload\PayloadInterface;

class ApiVersionPayload implements PayloadInterface {
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

    public function __construct(
        $version,
        $status,
        $isDeprecated
    )
    {
        $this->version = $version;
        $this->status = $status;
        $this->isDeprecated = $isDeprecated;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ApiVersionPayload(
                $object->version,
                $object->status,
                $object->isDeprecated
            );
    }
}
