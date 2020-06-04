<?php


namespace App\Tests\Behat\Context\Traits;

use App\Tests\Behat\Manager\AuthManager;

trait AuthTrait
{
    /**
     * The user to use with HTTP basic authentication
     *
     * @var string
     */
    protected $authUser;
    /**
     * The password to use with HTTP basic authentication
     *
     * @var string
     */
    protected $authPassword;
    /**
     * @var AuthManager
     */
    private AuthManager $authManager;

    /**
     * @Given /^I create user with email "([^"]*)" and password "([^"]*)"$/
     */
    public function iCreateUserWithEmailAndPassword($email, $password)
    {
        $authRequest = $this->authManager->requestAuthPayload($email, $password);

        // Send request
        $this->lastResponse = $this->client->request(
            "POST",
            "/users",
            [
                'headers' => $this->requestHeaders,
                'body' => $authRequest
            ]
        );
    }

    /**
     * @Given /^I login user "([^"]*)" and password "([^"]*)"$/
     */
    public function iLoginWithEmailAndPassword($email, $password)
    {
        $authRequest = $this->authManager->requestAuthPayload($email, $password);
        $this->lastResponse = $this->client->request(
            "POST",
            "/authentication_token",
            [
                'headers' => $this->requestHeaders,
                'body' => $authRequest
            ]
        );
    }
}
