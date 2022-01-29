<?php

require '../vendor/autoload.php';

use App\SalaryPayer;
use App\Repository\MySqlRepository;
use App\Calculator\Calculator;
use App\Notifier\YandexSmtpNotifier;

/**
 * Выплатить зарплату сотрудникам в зависимости от количества отработанных часов.
 *
 * - достать список всех сотрудников из источника;
 * - рассчитать количество денег для начисления;
 * - начисляем оплату;
 * - оповещение сотрудника на почту.
 */

$salaryPayer = new SalaryPayer(
    new MySqlRepository(),
    new Calculator(),
    new YandexSmtpNotifier(),
);
$salaryPayer->pay();
