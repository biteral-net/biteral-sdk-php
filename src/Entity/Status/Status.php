<?php

namespace Biteral\Entity\Status;

use DateTime;
use Biteral\Entity\EntityInterface;
use Biteral\Payload\Status\StatusPayload;

/**
 * Represents the status of the API and the request you made
 */
class Status implements EntityInterface {
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
     * @var \DateTimeImmutable $serverTime The timestamp of the server at the time of this request
     */
    public $serverTime;

    /**
     * @var int $environment The environment the server is running on
     */
    public $environment;

    public function __construct(
        $availableApiVersions,
        $latestStableMajorApiVersion,
        $requestMajorApiVersion,
        $clientId,
        $projectId,
        $roles,
        $permissions,
        $serverTime,
        $environment
    )
    {
        $this->availableApiVersions = $availableApiVersions;
        $this->latestStableMajorApiVersion = $latestStableMajorApiVersion;
        $this->requestMajorApiVersion = $requestMajorApiVersion;
        $this->clientId = $clientId;
        $this->projectId = $projectId;
        $this->roles = $roles;
        $this->permissions = $permissions;
        $this->serverTime = $serverTime;
        $this->environment = $environment;
    }

    public static function fromObject($object, $transformFromObject)
    {
        return
            new Status(
                $transformFromObject->entityFromObject($object->availableApiVersions),
                $object->latestStableMajorApiVersion,
                $object->requestMajorApiVersion,
                $object->clientId,
                $object->projectId,
                $object->roles,
                $object->permissions,
                new \DateTimeImmutable($object->serverTime, new \DateTimeZone('UTC')),
                $object->environment
            );
    }
}