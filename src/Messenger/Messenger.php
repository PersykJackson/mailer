<?php


namespace Mailer\Messenger;

use Mailer\Transport\MailerTransportInterface;
use Swift_Message;

class Messenger
{
    private \Swift_Mime_SimpleMessage $message;
    private array $config;
    private string $recipient;
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    public function to(string $recipient): self
    {
        $this->recipient = $recipient;
        return $this;
    }
    public function setMessage(string $message, string $title): self
    {
        $this->message = (new Swift_Message($title))
            ->setFrom(['maximarketmailer@gmail.com' => 'Maxi Market'])
            ->setTo([$this->recipient => 'Recipient'])
            ->setBody($message, 'text/html');
        return $this;
    }
    public function execute(): bool
    {
        $name = 'Mailer\Transport\\'.$this->config['defaultTransport'];
        $transport = new $name($this->config);
        $transport->send($this->message);
        return true;
    }
}
