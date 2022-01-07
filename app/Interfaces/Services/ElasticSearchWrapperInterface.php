<?php

namespace App\Interfaces\Services;

interface ElasticSearchWrapperInterface
{
    /**
     * Basic elasticsearch's search
     *
     * @param $index
     * @param $indices
     * @param $filters
     * @param int $size
     *
     * @return array
     */
    public function search($index, $indices, $filters, int $size = 10000): array;

    /**
     * Returns number of matches for a search query
     *
     * @param $index
     * @param $filters
     *
     * @return int
     */
    public function count($index, $filters): int;
}
