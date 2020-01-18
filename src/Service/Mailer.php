<?php


namespace App\Service;


class Mailer
{
    protected $mailer;
 
    public function __construct(\Swift_Mailer $mailer)
    {
    $this->mailer = $mailer;
    }
    

    /**
     * sendEmail
     *
     * @param  $consigne The consignee email address
     * @param  $header The subject of the email
     * @param  $content The content of the email
     * @param  $sender the sender of the email
     * @return void
     */
    public function sendEmail($consigne, $header, $content, $sender)
    {
        /** @var \Swift_Message $email */
        $email = new \Swift_Message($header);

        $email->setFrom($sender)
            ->setTo($consigne)
            ->setBody($content, 'text/html')
        ;

        return (bool) $this->mailer->send($email);
    }
}