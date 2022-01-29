<?php

namespace App;

use App\Calculator\CalculatorInterface;
use App\Notifier\NotifierInterface;
use App\Repository\RepositoryInterface;

final class SalaryPayer
{
    private RepositoryInterface $repository;
    private CalculatorInterface $calculator;
    private NotifierInterface $notifier;

    public function __construct(
        RepositoryInterface $repository,
        CalculatorInterface $calculator,
        NotifierInterface $notifier
    ) {
        $this->repository = $repository;
        $this->calculator = $calculator;
        $this->notifier = $notifier;
    }

    public function pay(): void
    {
        $employees = $this->repository->findAll();

        foreach ($employees as $employee) {
            $account = $this->calculator->calculate($employee);
            $this->repository->updateAccount($account, $employee->id);
            $this->notifier->notify('Salary', 'Account updated.', $employee->email, $employee->name);
        }
    }
}
