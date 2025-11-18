<?php

namespace Biteral\Service\Product;

use Biteral\Service\Service;
use Biteral\Entity\Product\Product;
use Biteral\Exception\ApiException;
use Biteral\Payload\Product\ProductPayload;

/**
 * A service to interact with your products on Biteral
 */
final class ProductsService extends Service {
    /**
     * @param string $code The code of the product as stored in your systems
     * @return Product
     * @throws ApiException
     */
    public function getByCode($code)
    {
        return $this->request(self::METHOD_GET, 'products', ['code' => $code]);
    }

    /**
     * @param string $id The Biteral Id of the product
     * @return Product
     * @throws ApiException
     */
    public function getById($id)
    {
        return $this->request(self::METHOD_GET, 'products', ['id' => $id]);
    }

    /**
     * @param string $code The code of the product as stored in your systems
     * @throws ApiException
     */
    public function deleteByCode($code)
    {
        return $this->request(self::METHOD_DELETE, 'products', ['code' => $code]);
    }

    /**
     * @param string $id The Biteral Id of the product
     * @throws ApiException
     */
    public function deleteById($id)
    {
        return $this->request(self::METHOD_DELETE, 'products', ['id' => $id]);
    }

    /**
     * @param ProductPayload $productPayload The product payload containing the data to be ingested about a product, or an array of product payloads to be ingested
     * @throws ApiException
     */
    public function ingest($productPayload)
    {
        $this->request(self::METHOD_POST, 'products', null, $productPayload);
    }
}
