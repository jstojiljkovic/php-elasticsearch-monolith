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
}
