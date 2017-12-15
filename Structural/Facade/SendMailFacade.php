<?php
/**
 * Created by PhpStorm.
 * User: TechWhizz
 */
//Ok so this looks pretty terrible, right? Everything is public and crappy method names!
interface SendMailInterface
{
    public function setSendToEmailAddress($emailAddress);
    public function setSubjectName($subject);
    public function setTheEmailContents($body);
    public function setTheHeaders($headers);
    public function getTheHeaders();
    public function getTheHeadersText();
    public function sendTheEmailNow();
}

/**
 * Implementing that crappy interface
 */
class SendMail implements SendMailInterface
{
    public $to, $subject, $body;
    public $headers = array();

    public function setSendToEmailAddress($emailAddress)
    {
        $this->to = $emailAddress;
    }

    public function setSubjectName($subject)
    {
        $this->subject = $subject;
    }

    public function setTheEmailContents($body)
    {
        $this->body = $body;
    }

    public function setTheHeaders($headers)
    {
        $this->headers = $headers;
    }

    public function getTheHeaders()
    {
        return $this->headers;
    }

    public function getTheHeadersText()
    {
        $headers = "";
        foreach ($this->getTheHeaders() as $header) {
            $headers .= $header . "\r\n";
        }
    }

    public function sendTheEmailNow()
    {
       // mail($this->to, $this->subject, $this->body, $this->getTheHeadersText());
        echo "Email sent.";
    }
}

/**
 * A facade wrapper around the crappy SendMail, to improve method names.
 */
class SendMailFacade
{
    private $sendMail;

    public function __construct(SendMailInterface $sendMail)
    {
        $this->sendMail = $sendMail;
    }

    public function setTo($to)
    {
        $this->sendMail->setSendToEmailAddress($to);
        return $this;
    }

    public function setSubject($subject)
    {
        $this->sendMail->setSubjectName($subject);
        return $this;
    }

    public function setBody($body)
    {
        $this->sendMail->setTheEmailContents($body);
        return $this;
    }

    public function setHeaders($headers)
    {
        $this->sendMail->setTheHeaders($headers);
        return $this;
    }

    public function send()
    {
        $this->sendMail->sendTheEmailNow();
    }
}

$to      = "test@techwhizz.com";
$subject = "Techwhizz Facade";
$body    = "This demonstrate the sendmail using facade pattern.";
$headers = array(
    "From: test@gmail.com"
);

// Using the minging SendMail class
echo "Send Email without facade : ";
$sendMail = new SendMail();
$sendMail->setSendToEmailAddress($to);
$sendMail->setSubjectName($subject);
$sendMail->setTheEmailContents($body);
$sendMail->setTheHeaders($headers);
$sendMail->sendTheEmailNow();


// Using the sexy SendMailFacade class
echo "<br/>------------------------<br/>Send Email using facade : ";
$sendMail       = new SendMail();
$sendMailFacade = new sendMailFacade($sendMail);
$sendMailFacade->setTo($to)->setSubject($subject)->setBody($body)->setHeaders($headers)->send();
