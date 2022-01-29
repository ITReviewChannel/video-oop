<?php

namespace App;

final class Employee
{
    public int $id;
    public string $name;
    public string $email;
    public int $account;
    public int $workHours;
    public int $paidHours;

    public function __construct(
        int $id,
        string $name,
        string $email,
        int $account,
        int $workHours,
        int $paidHours
    )
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->account = $account;
        $this->workHours = $workHours;
        $this->paidHours = $paidHours;
    }
}
