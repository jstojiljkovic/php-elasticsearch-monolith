<?php

namespace App\Services;

use App\Interfaces\Repositories\UserRepositoryInterface;
use App\Interfaces\Services\UserServiceInterface;

class UserService implements UserServiceInterface
{
    /**
     * @var UserRepositoryInterface
     */
    protected UserRepositoryInterface $userRepository;

    /**
     * UserService constructor.
     *
     * @param UserRepositoryInterface $userRepository
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * Stores user with the default role
     *
     * @param array $data
     *
     * @return array
     */
    public function store(array $data): array
    {
        $user = $this->userRepository->create($data);

        return $user;
    }
}
