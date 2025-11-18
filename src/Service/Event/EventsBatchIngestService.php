<?php

namespace Biteral\Service\Event;

use Biteral\Service\Service;
use Biteral\Exception\ApiException;
use Biteral\Payload\Event\EventPayload;
use Biteral\Service\Event\BatchIngestResult;
use Biteral\Service\Event\Exception\BatchIngestException;

/**
 * A service to ingest big amounts of events in Biteral by using batching
 */
final class EventsBatchIngestService extends Service {

    private $ingestedEventsCount;
    private $batchesCount;
    private $isSessionStarted = false;
    private $batchEventPayloads = [];
    private $itemsPerBatch = 100;

    /**
     * Starts an event ingestion session. Must be called before ingesting events.
     */
    public function startIngestionSession()
    {
        $this->ingestedEventsCount = 0;
        $this->batchesCount = 0;
        $this->isSessionStarted = true;
    }

    /**
     * @param EventPayload $eventPayload The event payload containing the data to be ingested about an event, or an array of event payloads to be ingested
     * @throws ApiException
     */
    public function ingest($eventPayload)
    {
        if (!$this->isSessionStarted) {
            throw new BatchIngestException('Batch event ingestion session not started');
        }

        $this->batchEventPayloads[] = $eventPayload;

        if (sizeof($this->batchEventPayloads) % $this->itemsPerBatch === 0) {
            $this->flush();
        }
    }

    /**
     * Completes the current ingestion session.
     * @return BatchIngestResult Resulting details of the ingestion session
     * @throws ApiException
     */
    public function finishIngestionSession()
    {
        if (!$this->isSessionStarted) {
            throw new BatchIngestException('Batch event ingestion session not started');
        }

        $this->flush();

        $this->isSessionStarted = false;

        return new BatchIngestResult($this->ingestedEventsCount, $this->batchesCount);
    }

    private function flush()
    {
        if (!$this->batchEventPayloads) {
            return;
        }

        $this->request(self::METHOD_POST, 'events', null, $this->batchEventPayloads);
        $this->ingestedEventsCount += sizeof($this->batchEventPayloads);
        $this->batchesCount ++;
        $this->batchEventPayloads = [];
    }
}
