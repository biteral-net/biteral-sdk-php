<?php

namespace Biteral\Service\Product;

use Biteral\Service\Service;
use Biteral\Exception\ApiException;
use Biteral\Payload\Product\ProductPayload;
use Biteral\Service\Product\BatchIngestResult;
use Biteral\Service\Product\Exception\BatchIngestException;

/**
 * A service to ingest big amounts of products in Biteral by using batching
 */
final class ProductsBatchIngestService extends Service {

    private $ingestedProductsCount;
    private $batchesCount;
    private $isSessionStarted = false;
    private $batchProductPayloads = [];
    private $itemsPerBatch = 100;

    /**
     * Starts a product ingestion session. Must be called before ingesting products.
     */
    public function startIngestionSession()
    {
        $this->ingestedProductsCount = 0;
        $this->batchesCount = 0;
        $this->isSessionStarted = true;
    }

    /**
     * @param ProductPayload $productPayload The product payload containing the data to be ingested about a product, or an array of product payloads to be ingested
     * @throws ApiException
     */
    public function ingest($productPayload)
    {
        if (!$this->isSessionStarted) {
            throw new BatchIngestException('Batch product ingestion session not started');
        }

        $this->batchProductPayloads[] = $productPayload;

        if (sizeof($this->batchProductPayloads) % $this->itemsPerBatch === 0) {
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

        return new BatchIngestResult($this->ingestedProductsCount, $this->batchesCount);
    }

    private function flush()
    {
        if (!$this->batchProductPayloads) {
            return;
        }

        $this->request(self::METHOD_POST, 'products', null, $this->batchProductPayloads);
        $this->ingestedProductsCount += sizeof($this->batchProductPayloads);
        $this->batchesCount ++;
        $this->batchProductPayloads = [];
    }
}
