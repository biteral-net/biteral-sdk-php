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

    const METHOD_GET = 0;
    const METHOD_POST = 1;
    const METHOD_DELETE = 2;

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

    protected function request($method, $endpoint, $body = null)
    {
        $url = $this->baseUrl.'/'.$endpoint;

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'X-API-Key: '.$this->apiKey,
                'X-API-Version: '.$this->version,
                'Accept: application/json',
            ],
        ];

        switch ($method) {
            case self::METHOD_POST:
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = $body ? json_encode($body) : '';
                $options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
                break;

            case self::METHOD_DELETE:
                $options[CURLOPT_CUSTOMREQUEST] = 'DELETE';
                if (!empty($body)) {
                    $options[CURLOPT_POSTFIELDS] = json_encode($body);
                    $options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/json';
                }
                break;

            case self::METHOD_GET:
                $options[CURLOPT_HTTPGET] = true;
                break;
        }

        $curlHandler = curl_init($url);
        curl_setopt_array($curlHandler, $options);

        $response = curl_exec($curlHandler);

        if ($response === false) {
            throw new ConnectionException(curl_error($curlHandler));
        }

        $statusCode = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
        curl_close($curlHandler);

        $response = $this->transformResponse($response);

        switch ($statusCode) {
            case 200:
            case 201:
                return $response;
            case 400:
                throw new BadRequestException(curl_error($curlHandler));
            case 401:
                throw new UnauthorizedException(curl_error($curlHandler));
            case 403:
                throw new ForbiddenException(curl_error($curlHandler));
            case 404:
                throw new NotFoundException(curl_error($curlHandler));
            case 409:
                throw new ConflictException(curl_error($curlHandler));
            case 429:
                throw new TooManyRequestsException(curl_error($curlHandler));
            case 500:
                throw new ServerErrorException(curl_error($curlHandler));
            case 503:
                throw new ServiceUnavailableException(curl_error($curlHandler));
        }

        return $response;
    }

    private function transformResponse($response)
    {
        return $this->transformFromObject->entityFromObject(json_decode($response));
    }
}
