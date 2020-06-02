<?php

namespace App\DataFixtures\Faker\Provider;

class UserProvider
{
    public static function hashPassword($pass)
    {
        return 'hash '.$pass;
    }
}


