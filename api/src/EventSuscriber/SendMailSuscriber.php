<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;

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
            KernelEvents::VIEW => ['sendMail', EventPriorities::POST_WRITE],
        ];
    }

    public function sendMail(ViewEvent $event): void
    {
        $data = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        /*if (!$data instanceof XXX || Request::METHOD_POST !== $method) {
            return;
        }*/

        $message = (new \Swift_Message('A new book has been added'))
            ->setFrom('system@example.com')
            ->setTo('contact@les-tilleuls.coop')
            ->setBody(sprintf('The book #%d has been added.', $data->getId()));
        #TODO: Link with token to send to candidate

        $this->mailer->send($message);
    }
}
