<?php

namespace App\Services;

use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Interfaces\Services\SearchServiceInterface;

class SearchService implements SearchServiceInterface
{
    /**
     * @var SearchRepositoryInterface
     */
    protected SearchRepositoryInterface $searchRepository;

    /**
     * SearchService constructor.
     *
     * @param SearchRepositoryInterface $searchRepository
     */
    public function __construct(SearchRepositoryInterface $searchRepository)
    {
        $this->searchRepository = $searchRepository;
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
       return $this->searchRepository->findAllText($field, $value);
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
        return $this->searchRepository->findBetweenDates($column, $start, $end);
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
        return $this->searchRepository->findByGeoLocation($latitude, $longitude, $distance);
    }
}
