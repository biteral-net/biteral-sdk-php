<?php

namespace Biteral\Payload;

abstract class Payload implements PayloadInterface {
    public function jsonSerialize()
    {
        return $this;
    }
}
