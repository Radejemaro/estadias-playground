$(document).ready(function () {
    var selectedId;

    $("table td").bind("contextmenu", function (e) {
        selectedId = $(this).closest("tr").data("id");
        $("#menu_derecho").css({
            display: "block",
            left: e.pageX,
            top: e.pageY,
        });
        return false;
    });

    $(document).click(function (e) {
        if (e.button == 0) {
            $("#menu_derecho").css("display", "none");
        }
    });

    $(document).keydown(function (e) {
        if (e.keyCode == 27) {
            $("#menu_derecho").css("display", "none");
            $("#edit-modal").hide();
        }
    });

    $("#delete").click(function () {
        if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
            $.ajax({
                url: "/tablets/" + selectedId,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.status == "success") {
                        $('tr[data-id="' + selectedId + '"]').remove();
                    } else {
                        alert("Error al eliminar el registro");
                    }
                },
            });
        }
    });

    // No incluir la parte de abrir el edit-modal aquí
});
