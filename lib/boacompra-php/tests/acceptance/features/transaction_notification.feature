Feature: Transaction notification
  As a developer
  I want a abstract layer
  For receive / make transaction notification

  Scenario Outline: Searching transactions
    Given request transactions between <initialOrderDate>, <finalOrderDate> dates
    When require transactions list
    Then should return transactions
    Examples:
      | initialOrderDate              | finalOrderDate                |
      | 2017-09-01T14:00:00.000-03:00 | 2017-09-30T14:00:00.000-03:00 |

  Scenario Outline: Searching transactions by code
    Given a transaction code <code>
    When require transactions
    Then should return transaction
    Examples:
      | code     |
      | 90197069 |
