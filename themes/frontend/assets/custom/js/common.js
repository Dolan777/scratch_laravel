$(document).ready(function () {
    $(document).on('submit', 'form#contact_form', function (e) {
        e.preventDefault();
        loader_start();
        $("#contact_form").find('.has-error').removeClass('has-error');
        $("#contact_form").find('.help-block').html('');
        $.post($(this).attr('action'),
                $(this).serialize(),
                function (resp) {
                    loader_stop();

                    if (resp.type == "success") {
                        $('#contact_form')[0].reset();
                        success_msg(resp.message);
                    } else if (resp.type == "warning") {
                        $.each(resp.message, function (index, elem) {
                            $("#" + index).closest(".form-group").addClass('has-error');
                            $("#" + index).closest(".form-group").find('.help-block').html(elem);
                        })
                    }

                }, 'json');
    })

    $(window).scroll(function () {
        var scroll = $(window).scrollTop();

        if (scroll >= 20) {
            $(".header").addClass("darkHeader");
        } else {
            $(".header").removeClass("darkHeader");
        }
    });
    if ($('.owl-carousel').length > 0) {
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            pagination: false,
            responsiveClass: true,
            responsive: {
                0: {
                    items: 1,
                    nav: true
                },
                600: {
                    items: 3,
                    nav: false
                },
                1000: {
                    items: 5,
                    nav: true,
                    loop: false,
                    margin: 20
                }
            }

        })
        $(".owl-prev").html('<i class="fa fa-chevron-left"></i>');
        $(".owl-next").html('<i class="fa fa-chevron-right"></i>');
    }
    if ($('#boxscroll').length > 0) {

        $('#boxscroll').niceScroll({cursorborder: "", cursorcolor: "#666", boxzoom: true});
    }

    setTimeout(function () {
        if ($.type($(".success_msg")) != "undefined") {
            if ($(".success_msg").css("display") == "block") {
                $(".success_msg").fadeOut();
            }
        }
        if ($.type($(".errorSummary")) != "undefined") {
            if ($(".errorSummary").css("display") == "block") {
                $(".errorSummary").fadeOut();
            }
        }
    }, 5000);
    $('.application-form-panel').find(".input").focus(function () {
        $(this).parent().addClass("focus");
    });
    if ($('.datepicker').length > 0) {
        $('.datepicker').datepicker({
            orientation: "left",
            autoclose: true,
            endDate: '+0d',
            format: 'dd-mm-yyyy'
        });
    }
    $(document).on('submit', "#submit-application-form", function (e) {
        e.preventDefault();
        loader_start();
        $('.has-error').removeClass('has-error');
        $('.help-block').html('');
        $.ajax({
            url: $(this).attr('action'),
            type: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData: false,
            success: function (resp) {
                loader_stop();
                if (resp.type == "success") {
                    $("#application_success").modal('show');
                } else {
                    $.each(resp.messages, function (index, elem) {
                        $("#field-" + index).addClass('has-error');
                        $("#field-" + index).find('.help-block').html(elem);
                    })
                }
            },
            error: function () {}
        })
    });
    $(document).on('change', '.schedule_index', function () {
        if ($(this).prop('checked') == true) {
            $(this).closest('.schedule_div').find('.timepicker').removeAttr('disabled');
        } else {
            $(this).closest('.schedule_div').find('.timepicker').attr('disabled', true);
        }
    });
    if ($('.timepicker').length > 0) {
        $('.timepicker').datetimepicker({
            datepicker: false,
            format: 'H:i'
        });
    }
});

function error_msg(error_str)
{
    $(".errorJsSummary").stop().attr("style", "display:none;").fadeIn('slow');
    $(".errorJsSummary").find('span').html(error_str);
    setTimeout(function () {
        $(".errorJsSummary").fadeOut();
    }, 5000);
}


function success_msg(msg)
{

    $(".successmsg").attr("style", "display:none;").fadeIn('slow');
    $(".successmsg").find('span').html(msg);
    setTimeout(function () {
        $(".successmsg").fadeOut();
    }, 5000);
}
function loader_start()
{
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #3c8dbc;" class="fa fa-spinner fa-spin fa-2x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
    }

    jQuery('#resultLoading').css({
        'width': '100%',
        'height': '100%',
        'position': 'fixed',
        'z-index': '10000000',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto'
    });

    jQuery('#resultLoading .bg').css({
        'background': '#ffffff',
        'opacity': '0.8',
        'width': '100%',
        'height': '100%',
        'position': 'absolute',
        'top': '0'
    });

    jQuery('#resultLoading>div:first').css({
        'width': '250px',
        'height': '75px',
        'text-align': 'center',
        'position': 'fixed',
        'top': '0',
        'left': '0',
        'right': '0',
        'bottom': '0',
        'margin': 'auto',
        'font-size': '16px',
        'z-index': '10',
        'color': '#ffffff'

    });

    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeIn(300);
    jQuery('body').css('cursor', 'wait');
}

function loader_stop()
{
    jQuery('#resultLoading .bg').height('100%');
    jQuery('#resultLoading').fadeOut(300);
    jQuery('body').css('cursor', 'default');
}