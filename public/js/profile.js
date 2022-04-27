$(document).ready(function (e) {
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $('#inputAvatar').change(function () {
        $('#imagePreview').removeAttr('hidden');
        if (!this.files[0]) {
            $('#imagePreview').attr('hidden', true);
        } else {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
$(document).on('submit', '#editForm', function (e) {
    e.preventDefault();
    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        data: new FormData(this),
        processData: false,
        contentType: false
    }).done(function (result) {
        if ($.isEmptyObject(result.errors)) {
            printMsg(result.success, '#formModal', true);
            window.location.href = window.location;
        } else {
            printMsg(result.errors, '#formModal', false);
        }
    }).fail(function (result) {
        var errors = result.responseJSON;
        printMsg(errors.errors, '#formModal', false);
    });
});
