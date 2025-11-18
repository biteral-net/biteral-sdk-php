<?php

namespace Biteral\Payload\Product;

use Biteral\Payload\Payload;

class ProductCategoryPayload extends Payload {
    /**
     * @var string $code The code of the category as stored in your system
     */
    public $code;

    /**
     * @var string $title The title of the category
     */
    public $title;

    /**
     * @var string $description The description of the category
     */
    public $description;

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ProductCategoryPayload([
                'code' => $object->code,
                'title' => $object->title,
                'description' => $object->description
            ]);
    }
}
