<?php

namespace Biteral\Payload;

interface PayloadInterface {
    public static function fromObject($object, $transformFromObject);
}
