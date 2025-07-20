<?php

namespace Biteral\Service;

use Biteral\Payload\Product\ProductPayload;

/**
 * A service to interact with your products on Biteral
 */
final class ProductsService extends Service {
    /**
     * @param string $code The code of the product as stored in your systems
     */
    public function getByCode($code)
    {
        return $this->request(self::METHOD_GET, 'products', ['code' => $code]);
    }

    /**
     * @param string $id The Biteral Id of the product
     */
    public function getById($id)
    {
        return $this->request(self::METHOD_GET, 'products', ['id' => $id]);
    }

    /**
     * @param ProductPayload $productPayload The product payload containing the data to be ingested about a product
     */
    public function ingest(ProductPayload $productPayload)
    {
        var_dump(json_encode($productPayload, JSON_PRETTY_PRINT)); die;
        return $this->request(self::METHOD_POST, 'products', null, json_encode($productPayload));
    }
}
