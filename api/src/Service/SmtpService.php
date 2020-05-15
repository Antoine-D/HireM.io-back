<?php

namespace App\Service;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Config\Definition\Exception\Exception;

class SmtpService extends AbstractController
{
    public function sendEmail($message, $email, $subject, $params, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message($message))
            ->setFrom('hirem.emailing@gmail.com')
            ->setSubject($subject)
            ->setTo($email)
            ->setBody(
                sprintf('Welcome to hireM.io. follow that link to confirm your email. %d', $params)
            );
        /*->setBody(
                $this->renderView(
                    $view,
                    ['name' => $params['name'], 'token' => $params['token']]
                ),
                'text/html'
            );*/

        $mailer->send($message);
    }
}
