Feature: Payment
  As a developer
  I want a abstract layer
  For make payment requests

  Scenario Outline: Create a customer
    Given a customer with email <email>
    Then should return a customer

    Examples:
      | email                  |
      | teste@boacompra.com.br |

  Scenario Outline: Create a order
    Given a order with <id>, <description>, <amount>
    And and amount must be grater than 1
    Then should return a order

    Examples:
      | id  | description | amount |
      | 995 | Testing     | 1000   |
      | 995 | Testing     | 100    |

  Scenario: Create a payment
    Given a payment with order and customer
    Then should return a payment

  Scenario: Request a Payment
    Given a payment request
    And i get data
    Then i submit a request payment