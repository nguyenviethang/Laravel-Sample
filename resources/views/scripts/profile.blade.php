<script type="text/javascript">
    $(document).ready(function(e) {
        $('#inputAvatar').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#imagePreview').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
    $(document).on('submit', '#editForm', function(e) {
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
</script>
