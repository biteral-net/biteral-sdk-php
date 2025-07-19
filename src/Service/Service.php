<?php

namespace Biteral\Service;

use Biteral\Exception\ConflictException;
use Biteral\Exception\NotFoundException;
use Biteral\Exception\ForbiddenException;
use Biteral\Exception\BadRequestException;
use Biteral\Exception\ConnectionException;
use Biteral\Transform\TransformFromObject;
use Biteral\Exception\ServerErrorException;
use Biteral\Exception\UnauthorizedException;
use Biteral\Exception\TooManyRequestsException;
use Biteral\Exception\ServiceUnavailableException;

abstract class Service {
    private $apiKey;
    private $version;
    private $baseUrl;
    private $transformFromObject;

    public function __construct(
        $apiKey,
        $version = null,
        $baseUrl = null
    )
    {
        $this->apiKey = $apiKey;
        if ($version) { $this->version = $version; }
        if ($baseUrl) { $this->baseUrl = $baseUrl; }
        $this->transformFromObject = new TransformFromObject;
    }

    protected function request($endpoint)
    {
        $url = $this->baseUrl.'/'.$endpoint;

        $ch = curl_init($url);

        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'X-API-Key: '.$this->apiKey,
                'X-API-Version: '.$this->version,
                'Accept: application/json',
            ],
        ]);

        $response = curl_exec($ch);

        if ($response === false) {
            throw new ConnectionException(curl_error($ch));
        }

        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $response = $this->transformResponse($response);

        switch ($statusCode) {
            case 200:
            case 201:
                return $response;
            case 400:
                throw new BadRequestException(curl_error($ch));
            case 401:
                throw new UnauthorizedException(curl_error($ch));
            case 403:
                throw new ForbiddenException(curl_error($ch));
            case 404:
                throw new NotFoundException(curl_error($ch));
            case 409:
                throw new ConflictException(curl_error($ch));
            case 429:
                throw new TooManyRequestsException(curl_error($ch));
            case 500:
                throw new ServerErrorException(curl_error($ch));
            case 503:
                throw new ServiceUnavailableException(curl_error($ch));
        }

        return $response;
    }

    private function transformResponse($response)
    {
        return $this->transformFromObject->entityFromObject(json_decode($response));
    }
}
