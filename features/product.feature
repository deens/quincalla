Feature: Product Page
    In order to view a product
    As a visitor
    I need to see product details and add to cart

    Scenario: View Product Page
        Given I am on "/products/culpa-nam-temporibus-tempora-commodi-ab-quia"
        Then I should see "Facere quasi molestiae."
        And I should see "$193.31"
