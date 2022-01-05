<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Models\Random;
use ElasticScoutDriverPlus\Support\Query;

class ElasticSearchSearchRepository implements SearchRepositoryInterface
{
    /**
     * Returns all random
     *
     * @return array
     */
    public function findAllPagination(): array
    {
        // TODO: Implement findAllPagination() method.
    }

    /**
     * Returns all the text matching the field value pair
     *
     * @param $field
     * @param $value
     *
     * @return array
     */
    public function findAllText($field, $value): array
    {
        $query = Query::match()
            ->field($field)
            ->query($value);

        $randomness = Random::searchQuery($query)->execute();

        $results = [];
        foreach($randomness->documents() as $random) {
            $results[] = $random->content();
        }

        return $results;
    }

    /**
     * Returns all the results matching between two dates
     *
     * @param $column
     * @param $start
     * @param $end
     *
     * @return array
     */
    public function findBetweenDates($column, $start, $end): array
    {
        $query = Query::range()
            ->field($column)
            ->gte($start)
            ->lte($end);

        $randomness = Random::searchQuery($query)->execute();

        $results = [];
        foreach($randomness->documents() as $random) {
            $results[] = $random->content();
        }

        return $results;
    }

    /**
     * Returns all the results matching geo location
     *
     * @param $latitude
     * @param $longitude
     * @param int $distance
     *
     * @return array
     */
    public function findByGeoLocation($latitude, $longitude, int $distance = 15): array
    {
        $query = [
            'bool' => [
                'filter' => [
                    'geo_distance' => [
                        'distance' => $distance,
                        'location' => [
                            'lat' => $latitude,
                            'lon' => $longitude
                        ]
                    ]
                ]
            ]
        ];

        $randomness = Random::searchQuery($query)->execute();

        $results = [];
        foreach($randomness->documents() as $random) {
            $results[] = $random->content();
        }

        return $results;
    }
}
