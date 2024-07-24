$(document).ready(function () {
    // Show/hide password
    $(document).on('click', '.toggle-password', function () {
        let input = $(this).siblings('input');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });


});
