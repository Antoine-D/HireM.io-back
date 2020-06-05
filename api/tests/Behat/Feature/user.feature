Feature: _User_
  Background:
    Given the following fixtures files are loaded:
      | parameters      |
      | user            |

  ###########################################################
  # ABOUT REGISTER : POST /user
  ###########################################################
  Scenario: register user : valid
    Given I have the payload
      """
      {
          "email": "test@test.test",
          "password": "azerty",
          "isRecruiter": true
      }
      """
    When I request "POST /users"
    Then the response status code should be 201
    Then I save the response in the reference "registered_user"
    Then I dump actual references
    And the "@type" property should be a string equalling "User"
    And the "@id" property should be an integer
    And the "offer_id" property should not exist

  Scenario: register user : invalid email
    Given I have the payload
      """
      {
          "email": "invalid email",
          "password": "azerty",
          "isRecruiter": true
      }
      """
    When I request "POST /users"
    And the response status code should not be 201

  Scenario: register user : missing isRecruiter
    Given I have the payload
      """
      {
          "email": "test@test.test",
          "password": "azerty"
      }
      """
    When I request "POST /users"
    And the response status code should not be 201
    And the response status code should be 500

  Scenario: register user : isRecruiter : wrong format
    Given I have the payload
      """
      {
          "email": "test@test.test",
          "password": "azerty",
          "isRecruiter": "wrong format"
      }
      """
    When I request "POST /users"
    And the response status code should not be 201
    And the response status code should be 400

  Scenario: register user : valid payload but email already exists
    Given I have the payload
      """
      {
          "email": "root@root.root",
          "password": "root",
          "isRecruiter": true
      }
      """
    When I request "POST /users"
    And the response status code should not be 201
    And the response status code should be 500

  Scenario: register user : too long email
    Given I have the payload
      """
      {
          "email": "roooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooot@root.root",
          "password": "root",
          "isRecruiter": true
      }
      """
    When I request "POST /users"
    And the response status code should not be 201
    And the response status code should be 500

  Scenario: register user : additional useless objects
    Given I have the payload
      """
      {
          "email": "test@test.test",
          "password": "root",
          "isRecruiter": true,
          "useless": {},
          "key": {"subkey": ""}
      }
      """
    When I request "POST /users"
    And the response status code should be 201

  ###########################################################
  # ABOUT LOGIN : POST /authentication_token
  ###########################################################

  Scenario: login user : valid
    Given I have the payload
      """
      {
          "email": "test2@test.test",
          "password": "test"
      }
      """
    When I request "POST /authentication_token"
    Then the response status code should be 200
    And the "token" property should be a string

    Scenario: login user : email invalid
    Given I have the payload
      """
      {
          "email": "invalid@email.com",
          "password": "azerty"
      }
      """
    When I request "POST /authentication_token"
    And the response status code should not be 201
    Then the response status code should be 401

    Scenario: login user : password invalid
    Given I have the payload
      """
      {
          "email": "terry.johns@example.org",
          "password": "invalidpassword"
      }
      """
    When I request "POST /authentication_token"
    And the response status code should not be 201
    Then the response status code should be 401

  Scenario: jwt test
    Given I login user "root@root.root" and password "root"
    Then I request "GET /applications"

  Scenario: authentication check with valid credentials
    Given I checked my token with user "test2@test.test" and password "test"
    And the response status code should be 200
    And the "token" property should be a string

  Scenario: authentication check with invalid password
    Given I checked my token with user "root@root.root" and password "azniodznonzdoa"
    And the response status code should be 401
    And the "message" property should be a string equalling "Invalid credentials."

  Scenario: authentication check with invalid email
    Given I checked my token with user "root@root.dadaroot" and password "root"
    And the response status code should be 401
    And the "message" property should be a string equalling "Invalid credentials."

  Scenario: authentication check with too much characters in email
    Given I checked my token with user "roooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooooot@root.dadaroot" and password "root"
    And the response status code should be 401
    And the "message" property should be a string equalling "Invalid credentials."
