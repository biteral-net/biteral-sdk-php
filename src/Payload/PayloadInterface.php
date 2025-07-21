<?php

namespace Biteral\Payload;

use JsonSerializable;

interface PayloadInterface extends JsonSerializable {
    public static function fromObject($object, $transformFromObject);
}
