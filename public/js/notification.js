// thông báo message
function printMsg(msg, idModal, status) {
    $(idModal + " #error").find("ul").html('');
    $(idModal + " #success").html('');
    if (status) {
        $(idModal + " #error").css('display', 'none');
        $(idModal + " #success").css('display', 'block');
        $.each(msg, function (key, value) {
            $(idModal + " #success").append('<strong>' + value + '</strong>');
        });
    } else {
        $(idModal + " #error").css('display', 'block');
        $(idModal + " #success").css('display', 'none');
        $.each(msg, function (key, value) {
            $(idModal + " #error").find("ul").append('<li>' + value + '</li>');
        });
    }
}
