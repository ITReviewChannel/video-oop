<?php

require '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

/**
 * Выплатить зарплату сотрудникам в зависимости от количества отработанных часов.
 *
 * - достать список всех сотрудников из источника;
 * - рассчитать количество денег для начисления;
 * - начисляем оплату;
 * - оповещение сотрудника на почту.
 */

try {
    $connection = new PDO('mysql:host=db;dbname=my_database_name', 'my_user_name', 'my_user_password');
} catch (\Exception $exception) {
    echo $exception->getMessage();
    exit;
}

$employees = $connection->query('SELECT * FROM employee')->fetchAll();

$mail = new PHPMailer(true);

foreach ($employees as $employee) {
    $salary = ($employee['work_hours'] - $employee['paid_hours']) * 1000;
    $account = $employee['account'] + $salary;

    $statement = $connection->prepare('UPDATE employee SET account = :account, paid_hours = work_hours WHERE id = :id');
    $statement->execute(
        [
            'account' => $account,
            'id' => $employee['id']
        ]
    );

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.example.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'user@example.com';
        $mail->Password = 'secret';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('robot@company.com', 'SalaryPayer');
        $mail->addAddress($employee['email'], $employee['name']);

        $mail->isHTML(true);
        $mail->Subject = 'Salary';
        $mail->Body = 'Account updated. New value: ' . $employee['account'] . '.';

        // $mail->send();
    } catch (Exception $exception) {
        echo "Mailer Error: {$exception->getMessage()}";
        exit;
    }
}
