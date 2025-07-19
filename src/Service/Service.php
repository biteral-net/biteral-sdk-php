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
use Biteral\Exception\UnknownRequestException;
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

    protected function request($method, $endpoint, $parameters = null, $body = null)
    {
        $url =
            $this->baseUrl.
            '/'.
            $endpoint.
            ($parameters ? '?'.http_build_query($parameters) : '');

        $options = [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'X-API-Key: '.$this->apiKey,
                'X-API-Version: '.$this->version,
                'Accept: application/json',
            ],
            CURLOPT_TIMEOUT => 10
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
        }

        $curlHandler = curl_init($url);
        curl_setopt_array($curlHandler, $options);

        $response = curl_exec($curlHandler);

        if ($response === false) {
            throw new ConnectionException(curl_error($curlHandler));
        }

        $statusCode = curl_getinfo($curlHandler, CURLINFO_HTTP_CODE);
        $curlError = curl_error($curlHandler);
        curl_close($curlHandler);

        $response = $this->transformResponse($response);

        $errorMessage = $response->data->code.($curlError ? ' / '.$curlError : '');

        switch ($statusCode) {
            case 200:
            case 201:
                return $response;
            case 400:
                throw new BadRequestException($errorMessage);
            case 401:
                throw new UnauthorizedException($errorMessage);
            case 403:
                throw new ForbiddenException($errorMessage);
            case 404:
                throw new NotFoundException($errorMessage);
            case 409:
                throw new ConflictException($errorMessage);
            case 429:
                throw new TooManyRequestsException($errorMessage);
            case 500:
                throw new ServerErrorException($errorMessage);
            case 503:
                throw new ServiceUnavailableException($errorMessage);
            default:
                throw new UnknownRequestException('HTTP code '.$statusCode.': '.$errorMessage);
        }
    }

    private function transformResponse($response)
    {
        return $this->transformFromObject->entityFromObject(json_decode($response));
    }
}
