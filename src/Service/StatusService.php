<?php

namespace Biteral\Service;

use Biteral\Entity\Status\Status;

/**
 * The service that allows you to request information about the status of the API and the request itself
 */
final class StatusService extends Service {
    /**
     * @return Status
     */
    public function get()
    {
        return $this->request('status');
    }
}
