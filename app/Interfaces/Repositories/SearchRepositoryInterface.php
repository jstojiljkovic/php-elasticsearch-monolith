<?php

namespace App\Interfaces\Repositories;

interface SearchRepositoryInterface
{
    /**
     * Returns all random
     *
     * @return array
     */
    public function findAllPagination(): array;

    /**
     * Returns all the text matching the field value pair
     *
     * @param $field
     * @param $value
     *
     * @return array
     */
    public function findAllText($field, $value): array;

    /**
     * Returns all the results matching between two dates
     *
     * @param $column
     * @param $start
     * @param $end
     *
     * @return array
     */
    public function findBetweenDates($column, $start, $end): array;

    /**
     * Returns all the results matching geo location
     *
     * @param $latitude
     * @param $longitude
     * @param int $distance
     *
     * @return array
     */
    public function findByGeoLocation($latitude, $longitude, int $distance = 15): array;
}
