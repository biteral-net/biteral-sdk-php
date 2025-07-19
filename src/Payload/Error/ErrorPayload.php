<?php

namespace Biteral\Payload\Error;

use Biteral\Payload\PayloadInterface;

class ErrorPayload implements PayloadInterface {
    /**
     * @var string $code The error code
     */
    public $code;

    public function __construct(
        $code
    )
    {
        $this->code = $code;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ErrorPayload(
                $object->code
            );
    }
}
