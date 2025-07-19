<?php

namespace Biteral;

use Biteral\Service\StatusService;

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
     * @return StatusService
     */
    public function status()
    {
        return new StatusService($this->apiKey, $this->version, $this->baseUrl);
    }
}
