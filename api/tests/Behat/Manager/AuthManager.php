<?php

namespace App\Tests\Behat\Manager;

use Exception;

class AuthManager
{
    private string $token;

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

    public function getToken() {
        // $authRequest = $this->requestAuthPayload($email, $password);
        // $this->lastResponse = $this->client->request(
        //     "POST",
        //     "/authentication_token",
        //     [
        //         'headers' => $this->requestHeaders,
        //         'body' => $authRequest
        //     ]
        // );

        // $data = json_decode($this->lastResponse);
        // dump($data->token);
        // return $data->token;
    }
}
