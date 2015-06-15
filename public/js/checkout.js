(function($){

    var $billingAddress = $('.billing-address'),
        $sameAddress = $('#same_address');

    var toggleBillingAddress = function() {
        if ($sameAddress.checked()) {
            $billingAddress.hide();
        } else {
            $billingAddress.display();
        }

    };

    $sameAddress.click(toggleBillingAddress);

    toggleBillingAddress();

})(jQuery);