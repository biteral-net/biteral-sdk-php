<?php

namespace Biteral\Transform;

use Biteral\Entity\Status\Status;
use Biteral\Entity\Product\Product;
use Biteral\Entity\Status\ApiVersion;

class TransformFromObject
{
    public function entityFromObject($object)
    {
        if (is_array($object)) {
            foreach ($object as $key => $subObject) {
                $object[$key] = $this->entityFromObject($subObject);
            }
        }

        switch ($object->object) {
            case 'status':
                return new Status($object, $this);
            case 'product':
                return new Product($object, $this);
            case 'api_version':
                return new ApiVersion($object, $this);
            default:
                return $object;
        }
    }

    public function payloadFromObject($class, $object)
    {
        if (is_array($object)) {
            foreach ($object as $key => $subObject) {
                $object[$key] = $this->payloadFromObject($class, $subObject);
            }
        }

        return new $class($object, $this);
    }
}
