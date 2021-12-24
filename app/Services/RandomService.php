<?php

namespace App\Services;

use App\Interfaces\Repositories\RandomRepositoryInterface;
use App\Interfaces\Services\RandomServiceInterface;

class RandomService implements RandomServiceInterface
{
    /**
     * @var RandomRepositoryInterface
     */
    protected RandomRepositoryInterface $randomRepository;

    /**
     * RandomService constructor.
     */
    public function __construct(RandomRepositoryInterface $randomRepository)
    {
        $this->randomRepository = $randomRepository;
    }

    /**
     * Creates random model
     *
     * @param array $data
     *
     * @return array
     */
    public function create(array $data): array
    {
        return $this->randomRepository->create($data);
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
        abort_unless($this->randomRepository->exists($id), 404, 'Random with the provided id does not exist.');

        return $this->randomRepository->update($id, $data);
    }

    /**
     * Returns all random
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->randomRepository->getAll();
    }

    /**
     * Deletes random
     *
     * @param int $id
     */
    public function delete(int $id): void
    {
        abort_unless($this->randomRepository->exists($id), 404, 'Random with the provided id does not exist.');

        $this->randomRepository->delete($id);
    }
}
