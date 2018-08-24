$(document).ready(function () {
    $(".gift_card").change(function (e) {
        var amount = 0;
        $.each($(".gift_card"), function (ind, elem) {
            if ($(elem).prop('checked') == true) {
                amount = parseFloat(amount) + parseFloat($(elem).attr('data-amount'));
            }
        });
        $("#total_amount").text(amount);
    })

    $(document).on('submit', 'form#gift_card_form', function (e) {
        e.preventDefault();
        loader_start();
        $("#contact_form").find('.has-error').removeClass('has-error');
        $("#contact_form").find('.help-block').html('');
        $.post($(this).attr('action'),
                $(this).serialize(),
                function (resp) {
                    

                    if (resp.type == "success") {
                        window.location.href=resp.red_url;
                    } else if (resp.type == "warning") {
                        loader_stop();
                        $.each(resp.message, function (index, elem) {
                            $("#" + index).closest(".form-group").addClass('has-error');
                            $("#" + index).closest(".form-group").find('.help-block').html(elem);
                        })
                    }

                }, 'json');
    })


})