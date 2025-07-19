<?php

namespace Biteral\Entity\Product;

use Biteral\Entity\Entity;

class Product extends Entity {
    public $data;

    public function __construct($object, $transformFromObject)
    {
        $this->data = $object->data;
    }
}
