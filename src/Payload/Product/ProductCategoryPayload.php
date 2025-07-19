<?php

namespace Biteral\Payload\Product;

use Biteral\Payload\PayloadInterface;

class ProductCategoryPayload implements PayloadInterface {
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

    public function __construct(
        $code,
        $title,
        $description
    )
    {
        $this->code = $code;
        $this->title = $title;
        $this->description = $description;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new ProductCategoryPayload(
                $object->code,
                $object->title,
                $object->description
            );
    }
}
