<?php

namespace App\EventListener;

use Lexik\Bundle\JWTAuthenticationBundle\Event\JWTCreatedEvent;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\UserRepository;

class JWTCreatedListener
{

    /**
     * @var RequestStack
     */
    private $requestStack;
    private $userRepository;

    /**
     * @param RequestStack $requestStack
     */
    public function __construct(RequestStack $requestStack, UserRepository $userRepository)
    {
        $this->requestStack = $requestStack;
        $this->userRepository = $userRepository;
    }

    /**
     * @param JWTCreatedEvent $event
     *
     * @return void
     */
    public function onJWTCreated(JWTCreatedEvent $event)
    {
        //$request = $this->requestStack->getCurrentRequest();

        $payload       = $event->getData();
        $currentUser = $this->userRepository->findOneBy(
            ['email' => $payload['username']]
        );

        $payload['user_id'] = $currentUser->getId();

        $event->setData($payload);

        $header        = $event->getHeader();
        $header['cty'] = 'JWT';

        $event->setHeader($header);
    }
}
