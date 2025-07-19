<?php

namespace Biteral\Entity\Product;

use Biteral\Entity\EntityInterface;

class Product implements EntityInterface {
    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new Product(
                $transformFromObject->payloadFromObject(Product::class, $object->data)
            );
    }
}
