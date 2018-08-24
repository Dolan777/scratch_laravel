$(document).ready(function(){
       $(document).on('submit', 'form.login_user_form', function (e) {
        e.preventDefault();
        loader_start();
        $('.has-error').removeClass('has-error');
        $('.help-block').html('');
        $.post($(this).attr('action'),
                $(this).serialize(),
                function (resp) {
                    loader_stop();
                    console.log(resp);
                    if (resp.type == "success") {
                        window.location.href = resp.url;
                    } else if (resp.type == "validation") {
                        $.each(resp.message, function (index, elem) {
                            $("#" + index).closest(".form-group").addClass('has-error');
                            $("#" + index).closest(".form-group").find('.help-block').html(elem);
                        })
                    } else if (resp.type == "warning") {
                        error_msg(resp.message);
                    }

                }, 'json');
    })
})

function open_forgotpassword(){
    $("#login_div").hide();
    $("#forgot_div").show();
}
function open_login(){
    $("#forgot_div").hide();
    $("#login_div").show();
    
}