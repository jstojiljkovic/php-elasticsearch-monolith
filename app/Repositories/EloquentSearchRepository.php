<?php

namespace App\Repositories;

use App\Interfaces\Repositories\SearchRepositoryInterface;
use App\Models\Random;

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
        return Random::where($field, 'like', '%' . $value . '%')->get()->toArray();
    }
}
