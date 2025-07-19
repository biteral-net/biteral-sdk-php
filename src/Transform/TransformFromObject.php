<?php

namespace Biteral\Transform;

use Biteral\Entity\Error\Error;
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
            case 'error':
                return Error::fromObject($object, $this);
            case 'status':
                return Status::fromObject($object, $this);
            case 'product':
                return Product::fromObject($object, $this);
            case 'api_version':
                return ApiVersion::fromObject($object, $this);
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

        return $class::fromObject($object, $this);
    }
}
