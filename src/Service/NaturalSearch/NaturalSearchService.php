<?php

namespace Biteral\Service\NaturalSearch;

use Biteral\Service\Service;
use Biteral\Entity\Product\Product;
use Biteral\Exception\ApiException;

/**
 * A service to interact with the natural search tool
 */
final class NaturalSearchService extends Service {
    /**
     * @param NaturalSearchQuery $naturalSearchQuery The parameters to perform the natural search
     * @return ?Product[] The matching products, or null if there were none
     * @throws ApiException
     */
    public function query($naturalSearchQuery)
    {
        return
            $this->request(
                self::METHOD_GET,
                'natural-search',
                [
                    'query' => $naturalSearchQuery->query,
                    'limit' => $naturalSearchQuery->limit
                ]
            );
    }
}
