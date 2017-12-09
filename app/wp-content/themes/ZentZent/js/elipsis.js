(function($) {
    $(document).ready(function() {

        var $elipsisContainers = $('.content-elipsis');

        $elipsisContainers.on('click', function (e) {
            $(e.target).removeClass('content-elipsis');
        });

    });
})(jQuery);