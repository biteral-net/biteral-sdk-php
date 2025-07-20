<?php

namespace Biteral\Service\Status;

use Biteral\Service\Service;
use Biteral\Entity\Status\Status;
use Biteral\Exception\ApiException;

/**
 * The service that allows you to request information about the status of the API and the request itself
 */
final class StatusService extends Service {
    /**
     * @return Status
     * @throws ApiException
     */
    public function get()
    {
        return $this->request(self::METHOD_GET, 'status');
    }
}
