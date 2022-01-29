<?php

namespace App\Notifier;

interface NotifierInterface
{
    public function notify(string $subject, string $text, string $email, string  $name): void;
}
