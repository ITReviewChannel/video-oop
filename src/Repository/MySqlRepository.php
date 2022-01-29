<?php

namespace App\Repository;

use App\Employee;
use \PDO;

final class MySqlRepository implements RepositoryInterface
{
    private ?PDO $connection;

    public function __construct()
    {
        try {
            $this->connection = new PDO(
                'mysql:host=db;dbname=my_database_name',
                'my_user_name',
                'my_user_password'
            );
        } catch (\Exception $exception) {
            echo $exception->getMessage();
            exit;
        }
    }

    public function findAll(): array
    {
        $employees = [];

        $rows = $this->connection->query('SELECT * FROM employee')->fetchAll();

        foreach ($rows as $row) {
            array_push($employees, new Employee(
                $row['id'],
                $row['name'],
                $row['email'],
                $row['account'],
                $row['work_hours'],
                $row['paid_hours'],
            ));
        }

        return $employees;
    }

    public function updateAccount(int $account, int $employeeId): void
    {
        $statement = $this->connection->prepare(
            'UPDATE employee SET account = :account, paid_hours = work_hours WHERE id = :id'
        );
        $statement->execute(
            [
                'account' => $account,
                'id' => $employeeId
            ]
        );
    }
}
