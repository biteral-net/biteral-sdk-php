<?php

namespace Biteral\Payload\Product;

use Biteral\Payload\PayloadInterface;

class ProductAttributePayload implements PayloadInterface {
    /**
     * @var string $name The name of the attribute
     */
    public $name;

    /**
     * @var string $value The value of the attribute
     */
    public $value;

    public function __construct(
        $name,
        $value
    )
    {
        $this->name = $name;
        $this->value = $value;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ProductAttributePayload(
                $object->name,
                $object->value
            );
    }
}
