<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Models\Random;
use Illuminate\Support\Facades\DB;

class EloquentSearchRepository implements SearchRepositoryInterface
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
        $data = Random::where($field, 'like', '%' . $value . '%')->get()->toArray();

        return $data;
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
        return Random::whereBetween($column, [ $start, $end ])->get()->toArray();
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
        return Random::select([
            '*',
            DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance') ])
            ->havingRaw('distance < ' . $distance)
            ->get()
            ->toArray();
    }

    /**
     * Returns all the results matching card type
     *
     * @param $type
     *
     * @return array
     */
    public function findByCardType($type): array
    {
        // TODO: Implement findByCardType() method.
    }
}
