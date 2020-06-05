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
