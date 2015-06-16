(function($){

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

})(jQuery);