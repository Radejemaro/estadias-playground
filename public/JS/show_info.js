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
        }
    });

    $("#edit").click(function () {
        var row = $('tr[data-id="' + selectedId + '"]');
        $("#edit-COLEGA").val(row.find("td").eq(0).text());
        $("#edit-PUESTO").val(row.find("td").eq(1).text());
        $("#edit-SN_YUBIKEY").val(row.find("td").eq(2).text());
        $("#edit-PIN_YUBIKEY").val(row.find("td").eq(3).text());
        $("#edit-modal").show();
    });

    $("#delete").click(function () {
        if (confirm("¿Estás seguro de que quieres eliminar este registro?")) {
            $.ajax({
                url: "/yubikeys/" + selectedId,
                type: "DELETE",
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
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

    $("#save-changes").click(function () {
        $.ajax({
            url: "/yubikeys/" + selectedId,
            type: "PUT",
            data: {
                COLEGA: $("#edit-COLEGA").val(),
                PUESTO: $("#edit-PUESTO").val(),
                SN_YUBIKEY: $("#edit-SN_YUBIKEY").val(),
                PIN_YUBIKEY: $("#edit-PIN_YUBIKEY").val(),
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            success: function (response) {
                if (response.status == "success") {
                    var row = $('tr[data-id="' + selectedId + '"]');
                    row.find("td").eq(0).text($("#edit-COLEGA").val());
                    row.find("td").eq(1).text($("#edit-PUESTO").val());
                    row.find("td").eq(2).text($("#edit-SN_YUBIKEY").val());
                    row.find("td").eq(3).text($("#edit-PIN_YUBIKEY").val());
                    $("#edit-modal").hide();
                } else {
                    alert("Error al guardar los cambios");
                }
            },
        });
    });
});
