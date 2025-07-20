<?php

namespace Biteral\Payload\Brand;

use Biteral\Payload\Payload;

class BrandPayload extends Payload {
    /**
     * @var string $code The code of the brand as stored in your system
     */
    public $code;

    /**
     * @var string $name The name of the attribute
     */
    public $name;

    public function __construct(
        $code,
        $name
    )
    {
        $this->code = $code;
        $this->name = $name;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new BrandPayload(
                $object->code,
                $object->name
            );
    }
}
