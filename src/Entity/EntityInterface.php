<?php

namespace Biteral\Entity;

interface EntityInterface {
    public static function fromObject($object, $transformFromObject);
}
