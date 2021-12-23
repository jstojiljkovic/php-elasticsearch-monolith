<?php

namespace App\Interfaces\Services;

interface UserServiceInterface
{
    /**
     * Stores user with the default role
     *
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array;
}
