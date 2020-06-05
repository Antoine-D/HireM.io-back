<?php


namespace App\Tests\Behat\Context\Traits;

use App\Tests\Behat\Manager\AuthManager;

trait AuthTrait
{
    /**
     * @var AuthManager
     */
    private AuthManager $authManager;
    protected $authUser;
    protected $authPassword;
    // private string $jwt;

    /**
     * @Given /^I create user with email "([^"]*)" and password "([^"]*)"$/
     */
    public function iCreateUserWithEmailAndPassword($email, $password)
    {
        $authRequest = $this->authManager->requestAuthPayload($email, $password);
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
     * @Given /^I checked my token with user "([^"]*)" and password "([^"]*)"$/
     */
    public function iCheckWithEmailAndPassword($email, $password)
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

    /**
     * @Given /^I login user "([^"]*)" and password "([^"]*)"$/
     * UNFINISHED
     */
    public function iLoginWithEmailAndPassword($email, $password)
    {
        $this->jwt = $this->authManager->getToken($email, $password);
    }
}
