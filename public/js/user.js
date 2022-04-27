//Reset formModal when close
$('#formModal').on('hidden.bs.modal', function () {
    $(this).find('form').trigger('reset');
    $('#errorUser').css('display', 'none');
    $('#department option:selected').each(function () {
        $(this).removeAttr("selected");
    });
    $(this).find('input').removeAttr('checked');
    $("#imagePreview").attr("src", '');
    $("#error").css('display', 'none');
    $('#imagePreview').attr('hidden', true);
});
//Show image when chose file upload
$(document).ready(function (e) {
    $("#birth_day").datepicker({
        dateFormat: 'yy-mm-dd'
    });
    $("#start_date").datepicker({
        dateFormat: 'yy-mm-dd'

    });
    $('#inputAvatar').change(function () {
        if (!this.files[0]) {
            $('#imagePreview').attr('hidden', true);
        } else {
            $('#imagePreview').removeAttr('hidden');
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});
//Change title modal
$('.addButton').click(function () {
    $("#lableTitle").html("Thêm nhân viên");
    $("form#editForm").prop('id', 'addForm');
    var action = $('#addUser').val();
    $("#addForm").attr("action", action);

});
//Store new user
$(document).on('submit', '#addForm', function (e) {
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
//Show user information
$(".editButton").click(function () {
    var id = $(this).val();
    var action = $('#updateUser').val();

    $("#lableTitle").html("Sửa nhân viên");
    $("form#addForm").prop('id', 'editForm');
    $("#editForm").attr("action", action);
    $('#imagePreview').removeAttr('hidden');
    $.ajax({
        url: `/${id}`,
        type: 'GET',
        dataType: 'json',
        data: {}
    }).done(function (data) {
        if (data['user'] != null) {
            var dob = (data.user.birth_day).substring(0, 10);
            var startWorkDate = (data.user.start_date).substring(0, 10);
            $('input[name="id"]').val(data.user.id);
            $('input[name="email"]').val(data.user.email);
            $('input[name="fullname"]').val(data.user.fullname);
            $('input[name="birth_day"]').val(dob);
            $('input[name="start_date"]').val(startWorkDate);
            $('input[name="phone"]').val(data.user.phone);
            $("#department option[value=" + data.user.depart.id + "]").attr('selected', 'selected');
            $("input[name=role_id][value=" + data.user.role_id + "]").attr('checked', 'checked');
            $("input[name=status][value=" + data.user.status + "]").attr('checked', 'checked');
            $("#imagePreview").attr("src", '/images/UserAvatar/' + data.user.avatar);
        } else {
            $('#errorUser').css('display', 'block');
        }
    });
});
//Update user
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
//Delete user
$(document).on('click', '.deleteUser', function () {
    var userID = $(this).attr('data-userid');
    var userEmail = $(this).attr('data-useremail');
    $("#userEmail").html(userEmail);
    $('#userIid').val(userID);
});
//Reset password user
$(document).on('click', '.resetPassword', function () {
    var userID = $(this).attr('data-userid');
    var userEmail = $(this).attr('data-useremail');
    $('#emailReset').html(userEmail);
    $('#idReset').val(userID);
});

$('#submit').submit(function () {
    $(this)
        .find('input[name]')
        .filter(function () {
            return !this.value;
        })
        .prop('name', '');
});

$(".exportButton").click(function () {
    var action = $('#exportData').val();
    $("#submit").attr("action", action);
    $("#submit").submit();
});

$(".filterButton").click(function () {
    var action = '';
    $("#submit").attr("action", action);
    $("#submit").submit();
});
