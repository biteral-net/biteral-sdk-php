<?php

namespace Biteral;

use Biteral\Service\Status\StatusService;
use Biteral\Service\Product\ProductsService;
use Biteral\Service\Product\ProductsBatchIngestService;

/**
 * The main entrypoint to start using the SDK
 */
class Client
{
    private $apiKey;
    private $version = 1;
    private $baseUrl = 'https://api.biteral.net';

    /**
     * @param string $apiKey Your Biteral API key, tied to one of your projects as defined in your dashboard.
     * @param ?string $version The version of the API to use. Leave it to null to use the latest available version.
     * @param ?string $baseUrl The base URL of Biteral's API. Leave it to null to use the default.
     */
    public function __construct(
        $apiKey,
        $version = null,
        $baseUrl = null
    )
    {
        $this->apiKey = $apiKey;
        if ($version) { $this->version = $version; }
        if ($baseUrl) { $this->baseUrl = $baseUrl; }
    }

    /**
     * Retrieve a StatusService object to interact with Biteral status
     * @return StatusService
     */
    public function status()
    {
        return new StatusService($this->apiKey, $this->version, $this->baseUrl);
    }

    /**
     * Retrieve a StatusService object to interact with Biteral products
     * @return ProductsService
     */
    public function products()
    {
        return new ProductsService($this->apiKey, $this->version, $this->baseUrl);
    }

    /**
     * Retrieve a StatusService object to ingest big amounts of products into Biteral
     * @return ProductsBatchIngestService
     */
    public function productsBatchIngest()
    {
        return new ProductsBatchIngestService($this->apiKey, $this->version, $this->baseUrl);
    }
}
