<b>Mailer</b><br/>
Author: Vladislav Zagidullin<hr/>
<h3>How to use:</h3><br>
<ol>
<li>Create .env file end fill like in .envExemple</li>
<li>Require autoload</li>
<li>Require classes:<br/>
use Mailer\Messenger\{
    Messenger,
    TemplateType
};</li>
<li>And use Mailer like:<br/>
$messenger = new Messenger(parse_ini_file('.env'));<br/>
$messenger->setTemplate(<br/>
    TemplateType::REGISTER_COMPLETE,<br/>
    'message')<br/>
    ->setTitle('Title')<br/>
    ->to('recipient@gmail.com')<br/>
    ->execute();
</ol>