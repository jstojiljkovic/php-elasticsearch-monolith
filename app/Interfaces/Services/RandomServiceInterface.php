<?php

namespace App\Interfaces\Services;

interface RandomServiceInterface
{
    /**
     * Creates random model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array;

    /**
     * Updates random
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function update(int $id, array $data): array;

    /**
     * Returns all random
     *
     * @return array
     */
    public function getAll(): array;

    /**
     * Deletes random
     *
     * @param int $id
     */
    public function delete(int $id): void;
}
