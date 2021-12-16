<?php

namespace App\Interfaces\Repositories;

interface UserRepositoryInterface
{
    /**
     * Creates user model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array;
}
