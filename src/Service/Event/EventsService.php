<?php

namespace Biteral\Service\Event;

use Biteral\Service\Service;
use Biteral\Entity\Event\Event;
use Biteral\Exception\ApiException;
use Biteral\Payload\Event\EventPayload;

/**
 * A service to interact with events on Biteral
 */
final class EventsService extends Service {
    /**
     * @param string $id The Biteral Id of the event
     * @return Event
     * @throws ApiException
     */
    public function getById($id)
    {
        return $this->request(self::METHOD_GET, 'events', ['id' => $id]);
    }

    /**
     * @param string $id The Biteral Id of the event
     * @throws ApiException
     */
    public function deleteById($id)
    {
        return $this->request(self::METHOD_DELETE, 'events', ['id' => $id]);
    }

    /**
     * @param EventPayload $eventPaylod The event payload containing the data to be ingested about an event, or an array of event payloads to be ingested
     * @throws ApiException
     */
    public function ingest($eventPayload)
    {
        $this->request(self::METHOD_POST, 'events', null, $eventPayload);
    }
}
