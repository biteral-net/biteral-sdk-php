<?php

namespace Biteral\Service\Event;

class BatchIngestResult
{
    public $ingestedEventsCount;
    public $batchesCount;

    public function __construct(
        $ingestedEventsCount,
        $batchesCount
    )
    {
        $this->ingestedEventsCount = $ingestedEventsCount;
        $this->batchesCount = $batchesCount;
    }
}
