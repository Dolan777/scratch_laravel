$(document).ready(function () {
    $(".guardian_user_type_radio").change(function (e) {
        loader_start();
        var userType = $(this).val();
        $("#other_content").html('');
        if (userType == 1) {
            getAddStudent();
            $("#add_student_btn_div").removeClass('no-display');
            $("#personal_id").closest('.form-group').removeClass('no-display');
        } else if (userType == 2) {
            $("#add_student_btn_div").addClass('no-display');
            $("#personal_id").closest('.form-group').addClass('no-display');
            loader_stop();
//            $.get(full_path + '/admin/get-guardian',
//                    {
//                    },
//                    function (resp) {
//                        $("#other_content").html(resp.html);
//                        $('.datepicker').datepicker({
//                            orientation: "left",
//                            autoclose: true,
//                            endDate: '+0d',
//                            format: 'yyyy-mm-dd'
//                        });
//                        loader_stop();
//                    }, 'json');
        }

    });

    $(document).on('submit', "#guardian_add_student", function (e) {
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
                    window.location.reload(true);
                } else {
                    $.each(resp.messages, function (index, elem) {
                        $("#" + index).closest('.form-group').addClass('has-error');
                        $("#" + index).closest('.form-group').find('.help-block').html(elem);
                    })
                }
            },
            error: function () {}
        })
    })
    $(document).on('submit', "#student_address_add_in_studio", function (e) {
        e.preventDefault();
        loader_start();
        $('.has-error').removeClass('has-error');
        $('.help-block').html('');
        $.post($(this).attr('action'),
                $(this).serialize(),
                function (resp) {
                    loader_stop();
                    if (resp.type == "success") {
                        $("#studio").html(resp.studio_html);
                        $("#current_studio_room_id").html(resp.room_html);
                        $("#student_location_modal").modal('hide');
                    } else if (resp.type == "warning") {
                        $.each(resp.message, function (index, elem) {
                            $("#" + index).closest('.form-group').addClass('has-error');
                            $("#" + index).closest('.form-group').find('.help-block').html(elem);
                        })
                    }

                }, 'json');
    });
    
    /**
     * Submit gift voucher form
     */
    $(document).on('submit', "#submit-giftvoucher-form", function (e) {
        e.preventDefault();
        loader_start();
        $('.has-error').removeClass('has-error');
        $('.help-block').html('');
        $.post($(this).attr('action'), $(this).serialize(), function (resp) {
            if (resp.type == "success") {
                window.location.href = resp.url;
            } else if (resp.type == "warning") {
                $.each(resp.messages, function (index, elem) {
                    $("#" + index).closest('.form-group').addClass('has-error');
                    $("#" + index).closest('.form-group').find('.help-block').html(elem);
                })
            } else if (resp.type == 'danger') {
                window.location.reload();
            }
            loader_stop();
        }, 'json');
    });
});

function getAddStudent() {
    loader_start();
    $.get(full_path + '/admin/get-student',
            {
                no_of_student: $("#other_content").find('.student').length,
                current_index: currentIndex
            },
            function (resp) {
                currentIndex++;
                $("#other_content").append(resp.html);
                $('.datepicker').datepicker({
                    orientation: "left",
                    autoclose: true,
                    endDate: '+0d',
                    format: 'yyyy-mm-dd'
                });
                loader_stop();
            }, 'json');
}

function removeStudentBlock(id) {
    $("#" + id).remove();
}