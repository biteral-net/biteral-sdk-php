<?php

namespace Biteral\Payload\Status;

use Biteral\Payload\Payload;

class ProductPayload extends Payload {
    /**
     * @var string $code The product code as stored in your system.
     */
    public $code;

    /**
     * @var string $title The product title.
     */
    public $title;

    /**
     * @var string $description The product description.
     */
    public $description;

    /**
     * @var PricePayload $price The product price.
     */
    public $price;

    public function __construct($object, $transformFromObject)
    {
        $this->code = $object->code;
        $this->title = $object->title;
        $this->description = $object->description;
        $this->price = $object->price;
    }
}
