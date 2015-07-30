Feature: Product Page
    In order to view a product
    As a visitor
    I need to see product details and add to cart

    Scenario: View Product Page
        Given I am on "/products/first-necklace-yellow-gold"
        Then I should see "First Necklace Yellow Gold"
        And I should see "$99.00"
