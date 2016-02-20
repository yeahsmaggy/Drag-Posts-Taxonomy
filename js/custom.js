jQuery(document).ready(function($) {
    $(".draggable").draggable({
        revert: true,
        start: function() {
            console.log('start');
        },
        drag: function() {
            console.log('draggoing');
        },
        stop: function() {
            console.log('stop');
        }
    });
    $(".droppable").droppable({
        activeClass: "ui-state-default",
        hoverClass: "ui-state-hover",
        drop: function(event, ui) {
            $(this).addClass("ui-state-highlight");
            // console.log(ui.draggable.text());
            console.log(ui.draggable.text());
            // console.log(ui.draggable.data('postid'));
            // console.log($(this).data('termid'));


            var postid = ui.draggable.data('postid');
            var termid = $(this).data('termid');
            var termslug = $(this).data('termslug');

             var filterParams = {};
             filterParams.postid = postid;
             filterParams.termid = termid;
             filterParams.termslug = termslug;

             console.log(filterParams);

            $.ajax({
                url: mnt_drop_action.ajaxurl,
                type: 'GET',
                data: ({
                    action: 'mnt_drop_action',
                    filterParams: filterParams
                }),
                success: function(data) {
                    console.log(data);


                },
                error: function(data) {}
            });



        }
    });
    console.log('working js');
});