<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Models\Random;
use ElasticScoutDriverPlus\Support\Query;

class CombinedRepository implements SearchRepositoryInterface
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
        $begin = microtime(true);
        $sqlCount = Random::where($field, 'like', '%' . $value . '%')->get()->count();
        $end = microtime(true) - $begin;


        $query = Query::match()
            ->field($field)
            ->query($value);

        $randomness = Random::searchQuery($query)->execute();

        dump($randomness);

        return [
          'time' => $randomness->raw()['took'] / 1000
        ];
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
        // TODO: Implement findBetweenDates() method.
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
        // TODO: Implement findByGeoLocation() method.
    }
}
