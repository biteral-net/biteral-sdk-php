<?php

namespace Biteral\Service\NaturalSearch;

class NaturalSearchQuery
{
    /**
     * @var string $query The search query as entered by the user
     */
    public $query;

    /**
     * @var int $limit The maximum number of products to obtain
     */
    public $limit;

    public function __construct(
        $query,
        $limit = null
    )
    {
        $this->query = $query;
        $this->limit = $limit;
    }
}
