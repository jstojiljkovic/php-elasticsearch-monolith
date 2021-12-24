<?php

namespace App\Interfaces\Repositories;

interface RandomRepositoryInterface
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
     * Checks whenever comment exists
     *
     * @param int $id
     *
     * @return bool
     */
    public function exists(int $id): bool;

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
