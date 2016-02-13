jQuery(document).ready(function($) {
var filterParams = '';

console.log('working js');
        $.ajax({
            url: mnt_do_sorting_script.ajaxurl,
            type: 'GET',
            data: ({
                action: 'mnt_do_sorting',
                filterParams: filterParams
            }),
            success: function(data) {




            },
            error: function(data) {}
        });


});