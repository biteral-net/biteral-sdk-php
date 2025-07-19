<?php

namespace Biteral\Service;

use Biteral\Payload\Status\ProductPayload;

/**
 * A service to interact with your products on Biteral
 */
final class ProductsService extends Service {
    public function ingest(ProductPayload $productPayload)
    {
        return $this->request(self::METHOD_POST, 'products');
    }
}
