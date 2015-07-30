Feature: Collection Page
    In order to view a collection
    As a visitor
    I need to see products by collection

    Scenario: View collection
        Given I am on "/collections/apple"
        Then I should see "Apple"
