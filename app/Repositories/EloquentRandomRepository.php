<?php

namespace App\Repositories;

use App\Interfaces\Repositories\RandomRepositoryInterface;
use App\Models\Random;

class EloquentRandomRepository implements RandomRepositoryInterface
{
    /**
     * Creates random model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array
    {
        return Random::create($data)->toArray();
    }

    /**
     * Updates random
     *
     * @param int $id
     * @param array $data
     *
     * @return array
     */
    public function update(int $id, array $data): array
    {
        $random = Random::find($id);
        $random->update($data);

        return $random->toArray();
    }

    /**
     * Checks whenever random exists
     *
     * @param int $id
     *
     * @return bool
     */
    public function exists(int $id): bool
    {
        return Random::where('id', $id)->exists();
    }

    /**
     * Returns all random
     *
     * @return array
     */
    public function getAll(): array
    {
        return Random::get()->toArray();
    }

    /**
     * Deletes random
     *
     * @param int $id
     */
    public function delete(int $id): void
    {
        Random::find($id)->delete();
    }
}
