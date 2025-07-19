<?php

namespace Biteral\Payload\Status;

use DateTime;
use Biteral\Payload\Payload;
use Biteral\Entity\Status\ApiVersion;
use Biteral\Payload\Status\ApiVersionPayload;

class StatusPayload extends Payload {
    /**
     * @var ApiVersion[] The API versions that are available on this server
     */
    public $availableApiVersions;

    /**
     * @var string $latestStableMajorApiVersion The latest available major API version
     */
    public $latestStableMajorApiVersion;

    /**
     * @var string $requestMajorApiVersion The major API version of your request
     */
    public $requestMajorApiVersion;

    /**
     * @var string $clientId The client Id you're working with on this request
     */
    public $clientId;

    /**
     * @var string $projectId The project Id you're working with on this request
     */
    public $projectId;

    /**
     * @var array $roles The roles that are available to you on this request
     */
    public $roles;

    /**
     * @var array $permissions The permissions you're granted on this request
     */
    public $permissions;

    /**
     * @var int $serverTime The timestamp of the server at the time of this request
     */
    public $serverTime;

    /**
     * @var int $environment The environment the server is running on
     */
    public $environment;

    public function __construct($object, $transformFromObject)
    {
        $this->availableApiVersions = $transformFromObject->entityFromObject($object->availableApiVersions);

        $this->latestStableMajorApiVersion = $object->latestStableMajorApiVersion;
        $this->requestMajorApiVersion = $object->requestMajorApiVersion;
        $this->clientId = $object->clientId;
        $this->projectId = $object->projectId;
        $this->roles = $object->roles;
        $this->permissions = $object->permissions;

        $serverTime = new DateTime($object->serverTime, new \DateTimeZone('UTC'));
        $this->serverTime = $serverTime->getTimestamp();

        $this->environment = $object->environment;
    }
}
