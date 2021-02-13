<?php


namespace Mailer\Transport;


interface MailerTransportInterface
{
    public function send($message): bool;
    public function __construct(array $config);
}