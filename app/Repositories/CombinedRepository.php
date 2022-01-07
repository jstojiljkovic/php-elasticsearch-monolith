<?php

namespace App\Repositories;

use App\Helpers\DataFormatter;
use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Interfaces\Services\ElasticSearchWrapperInterface;
use App\Models\Random;
use Illuminate\Support\Facades\DB;

class CombinedRepository implements SearchRepositoryInterface
{
    /**
     * @var ElasticSearchWrapperInterface
     */
    protected ElasticSearchWrapperInterface $elasticSearchWrapper;

    /**
     * CombinedRepository constructor.
     *
     * @param ElasticSearchWrapperInterface $elasticSearchWrapper
     */
    public function __construct(ElasticSearchWrapperInterface $elasticSearchWrapper)
    {
        $this->elasticSearchWrapper = $elasticSearchWrapper;
    }

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
        $sqlBegin = microtime(true);
        $sqlCount = Random::where($field, 'like', '%' . $value . '%')->get()->count();
        $sqlEnd = microtime(true) - $sqlBegin;

        $filters[] = [ 'operator' => 'eq', 'property' => $field, 'value' => $value ];

        $elasticBegin = microtime(true);
        $elasticCount = $this->elasticSearchWrapper->count('randomness', $filters);
        $elasticEnd = microtime(true) - $elasticBegin;

        return DataFormatter::formatCombinedData($sqlEnd, $sqlCount, $elasticEnd, $elasticCount);
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
        $sqlBegin = microtime(true);
        $sqlCount = Random::whereBetween($column, [ $start, $end ])->get()->count();
        $sqlEnd = microtime(true) - $sqlBegin;

        $filters[] = [ 'operator' => 'range', 'property' => $column, 'value' => [
            'gte' => $start,
            'lte' => $end
        ] ];

        $elasticBegin = microtime(true);
        $elasticCount = $this->elasticSearchWrapper->count('randomness', $filters);
        $elasticEnd = microtime(true) - $elasticBegin;

        return DataFormatter::formatCombinedData($sqlEnd, $sqlCount, $elasticEnd, $elasticCount);
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
        $sqlBegin = microtime(true);
        $sqlCount = Random::select([
            '*',
            DB::raw('( 6371 * acos( cos( radians(' . $latitude . ') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(' . $longitude . ') ) + sin( radians(' . $latitude . ') ) * sin( radians(latitude) ) ) ) AS distance') ])
            ->havingRaw('distance < ' . $distance)
            ->get()
            ->count();
        $sqlEnd = microtime(true) - $sqlBegin;

        $filters[] = [ 'operator' => 'geo_distance', 'value' => [
            'distance' => $distance . 'km',
            'location' => [
                'lat' => $latitude,
                'lon' => $longitude
            ]
        ] ];

        $elasticBegin = microtime(true);
        $elasticCount = $this->elasticSearchWrapper->count('randomness', $filters);
        $elasticEnd = microtime(true) - $elasticBegin;

        return DataFormatter::formatCombinedData($sqlEnd, $sqlCount, $elasticEnd, $elasticCount);
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
        $sqlBegin = microtime(true);
        $sqlCount = Random::where('type', $type)->count();
        $sqlEnd = microtime(true) - $sqlBegin;

        $filters[] = [ 'operator' => 'eq', 'property' => 'type', 'value' => $type ];

        $elasticBegin = microtime(true);
        $elasticCount = $this->elasticSearchWrapper->count('randomness', $filters);
        $elasticEnd = microtime(true) - $elasticBegin;

        return DataFormatter::formatCombinedData($sqlEnd, $sqlCount, $elasticEnd, $elasticCount);
    }
}
