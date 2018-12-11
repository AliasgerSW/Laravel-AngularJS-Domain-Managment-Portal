// Remove Item
$(".remove-item").click(function(e){
    e.preventDefault();
    var cObj = $(this);

    swal({
        title: "Are you sure?",
        text: "You will not be able to recover this item!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55  ",
        confirmButtonText: "Yes, delete it!",
        closeOnConfirm: false
    }, function () {
        cObj.parent('form').submit();
    });
});