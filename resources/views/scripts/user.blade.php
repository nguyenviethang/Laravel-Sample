<script type="text/javascript">
    //Reset formModal when close
    $('#formModal').on('hidden.bs.modal', function() {
        $(this).find('form').trigger('reset');
        $('#errorUser').css('display', 'none');
        $('#department option:selected').each(function() {
            $(this).removeAttr("selected");
        });
        $(this).find('input').removeAttr('checked');
        $("#imagePreview").attr("src", '');
        $("#error").css('display', 'none');
    });
    //Show image when chose file upload
    $(document).ready(function(e) {
        $('#inputAvatar').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
    //Change title modal
    $('.addButton').click(function() {
        $("#lableTitle").html("Thêm nhân viên");
        $("form#editForm").prop('id', 'addForm');
    });
    //Store new user
    $(document).on('submit', '#addForm', function(e) {
        e.preventDefault();
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: new FormData(this),
            processData: false,
            contentType: false
        }).done(function(result) {
            if ($.isEmptyObject(result.errors)) {
                printMsg(result.success, '#formModal', true);
                window.location.href = window.location;
            } else {
                printMsg(result.errors, '#formModal', false);
            }
        });
    });
    $(document).on('click', '.deleteUser', function() {
        var userID = $(this).attr('data-userid');
        var userEmail = $(this).attr('data-useremail');
        $("#userEmail").html(userEmail);
        $('#userIid').val(userID);
    });
</script>
