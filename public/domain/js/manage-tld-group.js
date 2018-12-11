jQuery(document).ready(function()
{

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function restoreRow(oTable, nRow) {
        var aData = oTable.fnGetData(nRow);
        var jqTds = $('>td', nRow);

        for (var i = 0, iLen = jqTds.length; i < iLen; i++) {
            oTable.fnUpdate(aData[i], nRow, i, false);
        }

        oTable.fnDraw();
    }

    function editRow(oTable, nRow) {
        var aData = oTable.fnGetData(nRow);
        var jqTds = $('>td', nRow);
        jqTds[0].innerHTML = '<input type="text" class="form-control input-small" value="' + aData[0] + '">';
        jqTds[1].innerHTML = '<a class="edit" href="">Save</a>';
        jqTds[2].innerHTML = '<a class="cancel" href="">Cancel</a>';
    }

    function saveRow(oTable, nRow) {
        var jqInputs = $('input', nRow);
        var id = $(nRow).data("id");
        //ajax call to update
        $.ajax({
            url : "tld-group/"+id,
            type : "PATCH",
            data : {
                name : jqInputs[0].value,
            },
            success : function(data) {
                if ($.isEmptyObject(data.error)) {
                    oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
                    //display toast success message
                    toastr["success"]("Successfully Updated", "Update TLD Group");

                } else {
                    //display toast error message
                    toastr["error"](data.error, "Update TLD Group");
                }

            }
        });

        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
        oTable.fnUpdate('<a class="delete" href="">Delete</a>', nRow, 2, false);
        oTable.fnDraw();
    }

    function cancelEditRow(oTable, nRow) {
        var jqInputs = $('input', nRow);
        oTable.fnUpdate(jqInputs[0].value, nRow, 0, false);
        oTable.fnUpdate('<a class="edit" href="">Edit</a>', nRow, 1, false);
        oTable.fnDraw();
    }

    var table = $('#tld-group-table');

    var oTable = table.dataTable({
        "lengthMenu": [
            [5, 15, 20, -1],
            [5, 15, 20, "All"] // change per page values here
        ],
        // set the initial value
        "pageLength": 10,
        "select":true,
        "responsive":true,
        "language": {
            "lengthMenu": " _MENU_ records"
        }, dom: 'Bfrtip',
        buttons: [
            'csv', 'excel', 'pdf', 'print'
        ],
        "columnDefs": [{ // set default column settings
            'orderable': true,
            'targets': [0]
        }, {
            "searchable": true,
            "targets": [0]
        }],
        "order": [
            [0, "asc"]
        ] // set first column as a default sort by asc
    });

    var tableWrapper = $("#tld-group-table-wrapper");

    tableWrapper.find(".dataTables_length select").select2({
        showSearchInput: false //hide search box with special css class
    }); // initialize select2 dropdown

    var nEditing = null;
    var nNew = false;

    $('#sample_editable_1_new').click(function (e) {
        e.preventDefault();

        if (nNew && nEditing) {
            if (confirm("Previous row not saved. Do you want to save it ?")) {
                saveRow(oTable, nEditing); // save
                $(nEditing).find("td:first").html("Untitled");
                nEditing = null;
                nNew = false;

            } else {
                oTable.fnDeleteRow(nEditing); // cancel
                nEditing = null;
                nNew = false;

                return;
            }
        }

        var aiNew = oTable.fnAddData(['', '', '', '', '', '']);
        var nRow = oTable.fnGetNodes(aiNew[0]);
        editRow(oTable, nRow);
        nEditing = nRow;
        nNew = true;
    });

    table.on('click', '.delete', function(e) {
        e.preventDefault();

        if (nEditing !== null && nEditing != nRow) {
            /* Get the row as a parent of the link that was clicked on */
            var nRow = $(this).parents('tr')[0];

            if (nEditing !== null && nEditing != nRow) {
                /* Currently editing - but not this row - restore the old before continuing to edit mode */
                $('#editConfirmModal').modal();
            } else if (nEditing == nRow && this.innerHTML == "Save") {
                /* Editing this row and want to save it */
                saveRow(oTable, nEditing);
                nEditing = null;
                //$('#saveConfirmModal').modal();
            }
        }
        else {
            var id = $(this).closest('tr').data('id');
            $(".confirm-modal-title").text("Delete Tld Group");
            $("#confirm-modal-btn").text("Delete");
            $('.confirm-modal-body').text("Are you sure to Delete?");
            $('#confirmModal').data('type', 'delete');
            $('#confirmModal').data('id', id).modal('show');
        }
    });

    table.on('click', '.cancel', function (e) {
        e.preventDefault();

        if (nNew) {
            oTable.fnDeleteRow(nEditing);
            nNew = false;
        } else {
            restoreRow(oTable, nEditing);
            nEditing = null;
        }
    });

    table.on('click', '.edit', function (e) {
        e.preventDefault();

        /* Get the row as a parent of the link that was clicked on */
        var nRow = $(this).parents('tr')[0];

        if (nEditing !== null && nEditing != nRow) {
            /* Currently editing - but not this row - restore the old before continuing to edit mode */
            $('#editConfirmModal').modal();
        } else if (nEditing == nRow && this.innerHTML == "Save") {
            /* Editing this row and want to save it */
            saveRow(oTable, nEditing);
            nEditing = null;
            //$('#saveConfirmModal').modal();
        } else {
            /* No edit in progress - let's start one */
            editRow(oTable, nRow);
            nEditing = nRow;
        }
    });

    //to add tld-group
    $("#add-tld-group-btn").click(function(){
        $.ajax({
            url : "tld-group",
            type : "POST",
            data : {
                name : $("#tld-name").val(),
            },
            success : function(data) {
                if ($.isEmptyObject(data.error)) {
                    //add to the data-table
                    var tldTable = $("#tld-group-table").DataTable();
                    var addedNode = tldTable.row.add([
                        data.name,
                        '<a class="edit" href="javascript:;">Edit</a>',
                        '<a class="delete" href="javascript:;">Delete</a>',
                    ]).draw(false).node();

                    $(addedNode).css('color', 'red');
                    $(addedNode).attr("data-id",data.id);
                    $("#tld-name").val("");
                    //hide modal
                    $("#add-tld-group-modal").modal('toggle');
                    //display toast success message
                    toastr["success"]("Successfully Added", "Add TLD Group");

                } else {
                    //display toast error message
                    toastr["error"](data.error, "Add TLD Group");
                }

            }
        });
    });

    $("#confirm-modal-btn").click(function () {
        var id = $('#confirmModal').data('id');
        var type = $('#confirmModal').data('type');
        var configData = {};
        switch (type) {
            case "delete" :
                configData.url = "tld-group/"+id;
                configData.type = "DELETE";
                break;
            case "restore" :
                configData.url = "tld-group-restore/"+id;
                configData.type = "POST";
                break;
            case "permanent-delete" :
                configData.url = "tld-group-permanent/"+id;
                configData.type = "DELETE";
                break;
        }
        $.ajax({
            url : configData.url,
            type : configData.type,
            success : function(data) {
                if ($.isEmptyObject(data.error)) {
                    $('[data-id=' + id + ']').remove();
                    //display toast success message
                    toastr["success"](data.msg, data.title);

                } else {
                    //display toast error message
                    toastr["error"](data.error, data.title);
                }

            }
        });
        $('#confirmModal').modal('hide');



    });

    table.on('click', '.restore', function(e) {
        e.preventDefault();
        var id = $(this).closest('tr').data('id');
        $('.confirm-modal-title').text("Restore Tld Group");
        $('#confirm-modal-btn').text('Restore');
        $('.confirm-modal-body').text("Are you sure to Restore?");
        $('#confirmModal').data('type', 'restore');
        $('#confirmModal').data('id', id).modal('show');
    });

    table.on('click', '.permanent-delete', function(e) {
        e.preventDefault();
        var id = $(this).closest('tr').data('id');
        $('.confirm-modal-title').text("Permanent Delete Tld Group");
        $('#confirm-modal-btn').text("Delete");
        $('.confirm-modal-body').text("Are you sure to Permanent Delete?");
        $('#confirmModal').data('type', 'permanent-delete');
        $('#confirmModal').data('id', id).modal('show');
    });

});