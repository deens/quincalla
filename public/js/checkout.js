(function($){

    var $billingAddress = $('.billing-address'),
        $sameAddress = $('#same_address');

    var toggleBillingAddress = function() {
        if ($sameAddress.is(":checked")) {
            $billingAddress.hide();
        } else {
            $billingAddress.show();
        }
    };

    $sameAddress.click(toggleBillingAddress);

    toggleBillingAddress;

})(jQuery);