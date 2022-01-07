<?php

namespace App\Helpers;

class DataFormatter
{
    /**
     * Format combined data to desired array
     *
     * @param $sqlTime
     * @param $sqlCount
     * @param $elasticTime
     * @param $elasticCount
     *
     * @return array[]
     */
    public static function formatCombinedData($sqlTime, $sqlCount, $elasticTime, $elasticCount): array
    {
        return [
            'mysql' => [
                'time' => $sqlTime,
                'results' => $sqlCount
            ],
            'elastic' => [
                'time' => $elasticTime,
                'results' => $elasticCount
            ]
        ];
    }
}
