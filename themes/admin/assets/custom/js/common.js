function loader_start()
{
    if (jQuery('body').find('#resultLoading').attr('id') != 'resultLoading') {
        jQuery('body').append('<div id="resultLoading" style="display:none"><div><i style="font-size: 46px;color: #F44336;" class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i></div><div class="bg"></div></div>');
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

function init_datepicker(class_name, start_today) {
    if ($('.' + class_name).length > 0) {
        if (start_today == true) {
            $('.' + class_name).datepicker({
                orientation: "left",
                autoclose: true,
                startDate: '+0d',
//                format: 'yyyy-mm-dd'
                format: 'dd-mm-yyyy'
            });
        } else {
            $('.' + class_name).datepicker({
                orientation: "left",
                autoclose: true,
                format: 'dd-mm-yyyy'
            });
        }
    }
}

function init_timepicker(class_name) {
    if ($('.' + class_name).length > 0) {
        $('.' + class_name).datetimepicker({
            datepicker: false,
            format: 'H:i',
            step: 30
        });
    }
}
function init_select2(class_name) {
    if ($('.' + class_name).length > 0) {
        console.log('d');
        $('.' + class_name).select2();
    }
}

function init_multiselect(class_name) {
    if ($("." + class_name).length > 0) {
        $('.' + class_name).multiSelect({
            selectableHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Search'>",
            selectionHeader: "<input type='text' class='form-control' autocomplete='off' placeholder='Search'>",
            afterInit: function (ms) {
                var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#' + that.$container.attr('id') + ' .ms-elem-selection.ms-selected';

                that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function (e) {
                            if (e.which === 40) {
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function (e) {
                            if (e.which == 40) {
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
            },
            afterSelect: function () {
                this.qs1.cache();
                this.qs2.cache();
            },
            afterDeselect: function () {
                this.qs1.cache();
                this.qs2.cache();
            }
        });
    }
}
