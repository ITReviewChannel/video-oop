<?php

namespace App\Repository;

interface RepositoryInterface
{
    public function findAll(): array;

    public function updateAccount(int $account, int $employeeId): void;
}
