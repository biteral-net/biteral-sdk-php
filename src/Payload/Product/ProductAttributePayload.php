<?php

namespace Biteral\Payload\Product;

use Biteral\Payload\Payload;

class ProductAttributePayload extends Payload {
    /**
     * @var string $title The title of the attribute
     */
    public $title;

    /**
     * @var string $value The value of the attribute
     */
    public $value;

    public function __construct(
        $title,
        $value
    )
    {
        $this->title = $title;
        $this->value = $value;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ProductAttributePayload(
                $object->title,
                $object->value
            );
    }
}
