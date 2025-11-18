<?php

namespace Biteral\Service\Customer;

class BatchIngestResult
{
    public $ingestedCustomersCount;
    public $batchesCount;

    public function __construct(
        $ingestedCustomersCount,
        $batchesCount
    )
    {
        $this->ingestedCustomersCount = $ingestedCustomersCount;
        $this->batchesCount = $batchesCount;
    }
}
