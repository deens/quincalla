Feature: Product Search
    In order to search for a product
    As a visitor
    I need to provide a query

    Scenario: Return search results
        Given I am on "/"
        And I fill in "query" with "Gold"
        And I press "Search"
        Then I am on "search?query=Gold"

    Scenario: Search return not results
        Given I am on "/"
        And I fill in "query" with "product-not-found-query"
        And I press "Search"
        Then I should see "Not Products Found"

    Scenario: Search should paginate
        Given I am on "/"
        And I fill in "query" with "a"
        And I press "Search"
        Then I should see "Search results for `a`"
        And I should see "«"
        And I should see "»"
        Then I follow "»" 
        And I am on "/search?page=2&query=a"
