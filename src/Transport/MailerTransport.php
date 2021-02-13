<?php


namespace Mailer\Transport;

use Swift_SmtpTransport;
use Swift_Mailer;

class MailerTransport implements MailerTransportInterface
{
    private array $config;
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    public function send($message): bool
    {
        $transport = new Swift_SmtpTransport(
            $this->config['smtp'],
            $this->config['port'],
            $this->config['encrypt']
        );
        $transport->setUsername($this->config['user']);
        $transport->setPassword($this->config['password']);
        $mailer = new Swift_Mailer($transport);
        if ($mailer->send($message)) {
            return true;
        }
        return false;
    }
}