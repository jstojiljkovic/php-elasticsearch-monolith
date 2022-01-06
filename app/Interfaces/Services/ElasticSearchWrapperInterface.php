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
}
