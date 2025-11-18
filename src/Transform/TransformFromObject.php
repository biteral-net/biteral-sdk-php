<?php

namespace Biteral\Transform;

use Biteral\Entity\Brand\Brand;
use Biteral\Entity\Error\Error;
use Biteral\Entity\Status\Status;
use Biteral\Entity\Product\Product;
use Biteral\Entity\Customer\Customer;
use Biteral\Entity\Status\ApiVersion;
use Biteral\Entity\Product\ProductCategory;
use Biteral\Entity\Product\ProductAttribute;

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
            case 'api_version':
                return ApiVersion::fromObject($object, $this);
            case 'product':
                return Product::fromObject($object, $this);
            case 'product_attribute':
                return ProductAttribute::fromObject($object, $this);
            case 'product_category':
                return ProductCategory::fromObject($object, $this);
            case 'brand':
                return Brand::fromObject($object, $this);
            case 'customer':
                return Customer::fromObject($object, $this);
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
