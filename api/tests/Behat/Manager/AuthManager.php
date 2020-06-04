<?php

namespace App\Tests\Behat\Manager;

use Exception;

class AuthManager
{
    /**
     * Returns the wanted auth payload.
     * Returns an error message if there is no request before.
     *
     * @param $email
     * @param $password
     *
     * @return string
     * @throws Exception
     */
    public function requestAuthPayload($email, $password)
    {
        return '{
            "email": "' . $email . '",
            "password": "' . $password . '"
        }';
    }
}
