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
}
