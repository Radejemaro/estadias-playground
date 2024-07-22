$(document).ready(function() {
    // Show/hide password
    $(document).on('click', '.toggle-password', function() {
        let input = $(this).siblings('input');
        if (input.attr('type') === 'password') {
            input.attr('type', 'text');
        } else {
            input.attr('type', 'password');
        }
    });

    // Context menu
    $('#tablet-table tbody tr').on('contextmenu', function(e) {
        e.preventDefault();
        const id = $(this).data('id');
        $('#menu_derecho').css({
            top: e.pageY + 'px',
            left: e.pageX + 'px',
            display: 'block'
        }).data('id', id);
    });

    $(document).click(function() {
        $('#menu_derecho').hide();
    });

    $('#menu_derecho li').click(function() {
        const action = $(this).attr('id');
        const id = $('#menu_derecho').data('id');

        if (action === 'delete') {
            deleteTablet(id);
        } else if (action === 'edit') {
            editTablet(id);
        }
    });

    function deleteTablet(id) {
        $.ajax({
            url: `/tablets/${id}`,
            type: 'DELETE',
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                location.reload();
            }
        });
    }

    function editTablet(id) {
        $.get(`/tablets/${id}/edit`, function(data) {
            $('#edit-modal #edit-COLEGA').val(data.COLEGA);
            $('#edit-modal #edit-CUENTA').val(data.CUENTA);
            $('#edit-modal #edit-ACOUNT_PASSWORD').val(data.ACOUNT_PASSWORD);
            $('#edit-modal #edit-PIN_DESBLOQUEO').val(data.PIN_DESBLOQUEO);
            $('#edit-modal #edit-MARCA').val(data.MARCA);
            $('#edit-modal #edit-MODELO').val(data.MODELO);
            $('#edit-modal #edit-AREA').val(data.AREA);
            $('#edit-modal').show();
            $('#edit-form').data('id', id);
        });
    }

    $('#save-changes').click(function() {
        const id = $('#edit-form').data('id');
        const data = $('#edit-form').serialize();
        $.ajax({
            url: `/tablets/update/${id}`,
            type: 'POST',
            data: data,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                $('#edit-modal').hide();
                location.reload();
            }
        });
    });
});
