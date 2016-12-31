(function($, window, document) {
    console.log('Welcome to admin');

    $('#collections-list').select2({
        placeholder: "Add collection",
        allowClear: true
    });

    $('#tags-list').select2({
      tags: true,
      placeholder: "Add tags"
    });

}(window.jQuery, window, document));
