<?php

namespace Biteral\Payload;

abstract class Payload implements PayloadInterface {
    private $setProperties = [];

    public function __construct($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
                $this->setProperties[$key] = true;
            }
        }
    }

    public function jsonSerialize()
    {
        $vars = get_object_vars($this);
        unset($vars['setProperties']);
        return array_intersect_key($vars, $this->setProperties);
    }
}
