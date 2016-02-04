<?php

namespace AppBundle\Service;
/**
 * Class EmailService
 * @package AppBundle\Service
 * @Author Raymond F. <raymond@studionone.com.au />
 */

Class EmailService
{
    protected $name;
    protected $email;
    protected $mailer;

    const FROM_EMAIL = 'info@studionone.com.au';

    /**
     * EmailService constructor.
     * @param EmailService $emailService
     */
    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * @param $name
     * @return int
     * @throws \Exception
     */
    public function sendEmail($name, $email)
    {
        if (is_null($name)) {
            throw new \Exception('You must provide a name please.');
        }

        $message = \Swift_Message::newInstance()
            ->setSubject('Hello ' . $email)
            ->setFrom(self::FROM_EMAIL)
            ->setTo($email)
            ->setBody('Hi ' . $name . ', Congradulation you have got this email', 'text/html');

        return $this->mailer->send($message);
    }
}