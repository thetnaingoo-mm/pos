<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function register(array $data): ?User;

    public function login(string $email, string $password): ?string;
}