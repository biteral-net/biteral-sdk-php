<?php

namespace Biteral\Payload\Error;

use Biteral\Payload\Payload;

class ErrorPayload extends Payload {
    /**
     * @var string $code The error code
     */
    public $code;

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ErrorPayload([
                'code' => $object->code
            ]);
    }
}
