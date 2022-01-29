<?php

namespace App\Calculator;

use App\Employee;

interface CalculatorInterface
{
    public function calculate(Employee $employee): int;
}
