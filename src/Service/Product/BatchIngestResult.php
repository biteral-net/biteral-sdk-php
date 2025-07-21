<?php

namespace Biteral\Service\Product;

class BatchIngestResult
{
    public $ingestedProductsCount;
    public $batchesCount;

    public function __construct(
        $ingestedProductsCount,
        $batchesCount
    )
    {
        $this->ingestedProductsCount = $ingestedProductsCount;
        $this->batchesCount = $batchesCount;
    }
}
