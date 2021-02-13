<?php


namespace Mailer\Messenger;

use Swift_Message;

class Messenger
{
    private string $message;
    private array $config;
    private string $recipient;
    private string $title;
    public function __construct(array $config)
    {
        $this->config = $config;
    }
    public function to(string $recipient): self
    {
        $this->recipient = $recipient;
        return $this;
    }
    public function setTemplate(string $template, string $message): self
    {
        $template = file_get_contents(__DIR__.$this->config['templateFolder'].$template.".php");
        $this->message = str_replace('{message}', $message, $template);
        return $this;
    }
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }
    public function setConfigElement(string $key, string $value): void
    {
        $this->config[$key] = $value;
    }
    public function execute(): bool
    {
        $message = (new Swift_Message($this->title))
            ->setFrom(['maximarketmailer@gmail.com' => 'Maxi Market'])
            ->setTo([$this->recipient => 'Recipient'])
            ->setBody($this->message, 'text/html');
        $name = 'Mailer\Transport\\'.$this->config['defaultTransport'];
        $transport = new $name($this->config);
        $transport->send($message);
        return true;
    }
}
