<?php

namespace Biteral;

use Biteral\Service\Status\StatusService;
use Biteral\Service\Product\ProductsService;
use Biteral\Service\Customer\CustomersService;
use Biteral\Service\NaturalSearch\NaturalSearchService;
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
     * Retrieve a ProductsService object to interact with Biteral products
     * @return ProductsService
     */
    public function products()
    {
        return new ProductsService($this->apiKey, $this->version, $this->baseUrl);
    }

    /**
     * Retrieve a ProductsBatchIngestService object to ingest big amounts of products into Biteral
     * @return ProductsBatchIngestService
     */
    public function productsBatchIngest()
    {
        return new ProductsBatchIngestService($this->apiKey, $this->version, $this->baseUrl);
    }

    /**
     * Retrieve a CustomersService object to interact with Biteral products
     * @return CustomersService
     */
    public function customers()
    {
        return new CustomersService($this->apiKey, $this->version, $this->baseUrl);
    }

    /**
     * Retrieve a NaturalSearchService object to interact with the natural search tool
     * @return NaturalSearchService
     */
    public function naturalSearch()
    {
        return new NaturalSearchService($this->apiKey, $this->version, $this->baseUrl);
    }
}
