$(document).ready(function () {
    $('.wcp-comment-reply').click(function () {

        let token = jQuery(this).data('token');
        let comment_id = jQuery(this).data('comment-id');
        let html = "<div class='reply-section'>\
                    <form method='post' action='add_reply/" + comment_id + "'>\
                    <input type='hidden' name='_token' value='" + token + "' class='wcp_csrf_token'>\
                    <textarea name='reply' class='form-control reply-area'></textarea>\
                    <br/>\
                    <button type='submit' class='btn btn-primary reply-process'>Reply</button>\
                    <button class='btn btn-danger reply-cancel'>Cancel</button>\
                    </form>\
                 </div>";
        let parent_container = $(this).parent().parent();
        $(html).insertAfter(parent_container);
    });

    $(document).on('click', '.reply-cancel', function () {
        $(this).parent().remove();
    });

    // You can add more event handlers here if needed.
});