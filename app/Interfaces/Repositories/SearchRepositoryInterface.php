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
}
