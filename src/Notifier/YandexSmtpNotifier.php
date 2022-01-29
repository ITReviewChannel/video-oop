<?php

namespace App\Notifier;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

final class YandexSmtpNotifier implements NotifierInterface
{
    private PHPMailer $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
    }

    public function notify(string $subject, string $text, string $email, string $name): void
    {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = 'smtp.example.com';
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = 'user@example.com';
            $this->mailer->Password = 'secret';
            $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $this->mailer->Port = 465;

            $this->mailer->setFrom('robot@company.com', 'SalaryPayer');
            $this->mailer->addAddress($email, $name);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;
            $this->mailer->Body = $text;

            // $mail->send();
        } catch (Exception $exception) {
            echo "Mailer Error: {$exception->getMessage()}";
            exit;
        }
    }
}
