Feature: Shopping Cart
    In order to checkout
    As a visitor
    I need to update my shopping cart

    Scenario: Should Be Empty
        Given I am on "/cart"
        Then I should see "Your shopping cart is empty."

    Scenario: Add Product
        Given I add to cart "culpa-nam-temporibus-tempora-commodi-ab-quia"
        When I am on "/cart"
        Then I should see "Facere quasi molestiae."

    Scenario: Remove Product
        Given I add to cart "culpa-nam-temporibus-tempora-commodi-ab-quia"
        When I am on "/cart"
        And I follow "remove"
        Then I should see "Product has been deleted from your shopping cart"
        And I should see "Your shopping cart is empty."

    Scenario: Empty Cart
        Given I add to cart "culpa-nam-temporibus-tempora-commodi-ab-quia"
        When I am on "/cart"
        Then I should see "Facere quasi molestiae."
        And I follow "Empty Shopping Cart"
        Then I should see "Your shopping cart is empty."

