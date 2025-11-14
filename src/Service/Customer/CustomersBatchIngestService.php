<?php

namespace Biteral\Service\Customer;

use Biteral\Service\Service;
use Biteral\Exception\ApiException;
use Biteral\Payload\Customer\CustomerPayload;
use Biteral\Service\Customer\BatchIngestResult;
use Biteral\Service\Customer\Exception\BatchIngestException;

/**
 * A service to ingest big amounts of customers in Biteral by using batching
 */
final class CustomersBatchIngestService extends Service {

    private $ingestedCustomersCount;
    private $batchesCount;
    private $isSessionStarted = false;
    private $batchCustomerPayloads = [];
    private $itemsPerBatch = 100;

    /**
     * Starts a customer ingestion session. Must be called before ingesting customers.
     */
    public function startIngestionSession()
    {
        $this->ingestedCustomersCount = 0;
        $this->batchesCount = 0;
        $this->isSessionStarted = true;
    }

    /**
     * @param CustomerPayload $customerPayload The customer payload containing the data to be ingested about a customer, or an array of customer payloads to be ingested
     * @throws ApiException
     */
    public function ingest($customerPayload)
    {
        if (!$this->isSessionStarted) {
            throw new BatchIngestException('Batch product ingestion session not started');
        }

        $this->batchCustomerPayloads[] = $customerPayload;

        if (sizeof($this->batchCustomerPayloads) % $this->itemsPerBatch === 0) {
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
            throw new BatchIngestException('Batch product ingestion session not started');
        }

        $this->flush();

        $this->isSessionStarted = false;

        return new BatchIngestResult($this->ingestedCustomersCount, $this->batchesCount);
    }

    private function flush()
    {
        if (!$this->batchCustomerPayloads) {
            return;
        }

        $this->request(self::METHOD_POST, 'customers', null, $this->batchCustomerPayloads);
        $this->ingestedCustomersCount += sizeof($this->batchCustomerPayloads);
        $this->batchesCount ++;
        $this->batchCustomerPayloads = [];
    }
}
