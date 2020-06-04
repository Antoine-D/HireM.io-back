<?php

namespace App\DataFixtures\Faker\Provider;

use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserProvider
{
    private $pwdEncoder;

    public function __construct( UserPasswordEncoderInterface $pwdEncoder )
    {
        $this->pwdEncoder = $pwdEncoder;
    }

    public function hashPassword( $pass )
    {
        $user = new User();

        $encoded = $this->pwdEncoder->encodePassword($user, $pass);

        $user->setPassword($encoded);

        return $user->getPassword();
    }
}


