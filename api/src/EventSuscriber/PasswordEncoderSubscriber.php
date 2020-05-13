<?php

namespace App\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

final class PasswordEncoderSubscriber implements EventSubscriberInterface
{

    private $passwordEncoded;

    public function __construct(UserPasswordEncoderInterface $pwdEncoder)
    {
        $this->passwordEncoded = $pwdEncoder;
    }

    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => ['encodePassword', EventPriorities::PRE_WRITE],
        ];
    }

    public function encodePassword(ViewEvent $event)
    {
        $data = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if (!$data instanceof User || Request::METHOD_POST !== $method) {
            return;
        }

        $passwordEncoded = $this->passwordEncoded->encodePassword($data, $data->getPassword());
        $data->setPassword($passwordEncoded);
    }
}
