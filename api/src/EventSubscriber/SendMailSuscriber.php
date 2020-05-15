<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use App\Service\SmtpService;

final class SendMailSuscriber implements EventSubscriberInterface
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['SendMailSuscriber', EventPriorities::PRE_WRITE],
        ];
    }

    public function SendMailSuscriber(ViewEvent $event): void
    {
        $data = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$data instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        SmtpService::sendEmail('A new user has been added', $data->getEmail(), 'Welcome', $data->getEmail(), $this->mailer);

        /*$message = (new \Swift_Message('A new user has been added'))
            ->setFrom('system@example.com')
            ->setTo('contact@les-tilleuls.coop')
            ->setBody(sprintf('The book #%d has been added.', $data->getId()));
        #TODO: Link with token to send to candidate

        $this->mailer->send($message);*/
    }
}
