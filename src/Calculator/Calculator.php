<?php

namespace App\Calculator;

use App\Employee;

final class Calculator implements CalculatorInterface
{
    public function calculate(Employee $employee): int
    {
        return $employee->account + ($employee->workHours - $employee->paidHours) * 1000;
    }
}
