/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

Vue.component('example', require('./components/Example.vue'));

(function($, window, document) {
    console.log('Welcome to Quincalla');
    // Navigation dropdown.
    $(".dropdown-toggle").dropdown();

    // Checkout billing.
    var $billingAddress = $('.billing-address'),
        $sameAddress = $('#same_address');

    var checkout = {
        init: function() {
            this.toggleBillingAddress();
        },
        toggleBillingAddress: function() {
            if ($sameAddress.is(":checked")) {
                $billingAddress.hide();
            } else {
                $billingAddress.show();
            }
        }
    };

    // on click
    $sameAddress.click(checkout.toggleBillingAddress);

    // init
    checkout.init();

}(window.jQuery, window, document));
