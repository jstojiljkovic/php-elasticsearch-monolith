<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Interfaces\Services\ElasticSearchWrapperInterface;

class ElasticSearchSearchRepository implements SearchRepositoryInterface
{
    /**
     * @var ElasticSearchWrapperInterface
     */
    protected ElasticSearchWrapperInterface $elasticSearchWrapper;

    /**
     * ElasticSearchSearchRepository constructor.
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
        $filters[] = [ 'operator' => 'eq', 'property' => $field, 'value' => $value ];

        return $this->elasticSearchWrapper->search('randomness', '*', $filters);
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
        $filters[] = [ 'operator' => 'range', 'property' => $column, 'value' => [
            'gte' => $start,
            'lte' => $end
        ] ];

        return $this->elasticSearchWrapper->search('randomness', '*', $filters);
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
        $filters[] = [ 'operator' => 'geo_distance', 'value' => [
            'distance' => $distance . 'km',
            'location' => [
                'lat' => $latitude,
                'lon' => $longitude
            ]
        ] ];

        return $this->elasticSearchWrapper->search('randomness', '*', $filters);
    }
}
