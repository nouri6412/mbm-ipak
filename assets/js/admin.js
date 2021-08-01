(function ($) {
    $(document).ready(function () {
        console.log('ready');
    });
    $(document).bind("ajaxStart.mine", function() {
      $('.loading-ajax').show();
    });
    
    $(document).bind("ajaxStop.mine", function() {
        $('.loading-ajax').hide();
    });
})(jQuery);
