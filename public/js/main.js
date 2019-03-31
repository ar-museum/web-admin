// Callable functions
$(document).off('click', '[data-action]').on('click', '[data-action]', function (e) {
    if (true !== e.handled) {
        var action_name = window[$(this).data('action')];

        if (typeof action_name == 'function') {
            action_name(this, e);
        }

        e.handled = true;
    }
});

function remove_errors() {
    var _formGroups = $('.form-group.has-error');

    _formGroups.children('.help-block').remove();
    _formGroups.removeClass('has-error');
}

function handle_errors(errors) {
    remove_errors();

    if (errors.hasOwnProperty('success') && !errors['success']) {
        toastr['error']('', errors['message']);
    } else {
        for (var el in errors) {
            if (errors.hasOwnProperty(el)) {
                var $el = $('#' + el);
                $el.closest('.form-group').addClass('has-error');
                $el.after('<p class="help-block">' + errors[el] + '</p>');
            }
        }
    }
}

function responsiveView() {
    var wSize = $(window).width();
    if (wSize <= 768) {
        $('#container').addClass('sidebar-close');
        $('#sidebar > ul').hide();
    }

    if (wSize > 768) {
        $('#container').removeClass('sidebar-close');

        if (!$('#container').hasClass('sidebar-closed')) {
            $('#sidebar > ul').show();
        }
    }
}

$(function () {
    var _body = $('body');

    // CSRF protection
    $.ajaxSetup({
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Notification library config
    toastr.options = {
        closeButton: true,
        debug: false,
        extendedTimeOut: "1000",
        hideDuration: "1000",
        hideEasing: "linear",
        hideMethod: "fadeOut",
        positionClass: "toast-bottom-right",
        preventDuplicates: undefined,
        progressBar: false,
        showDuration: "700",
        showEasing: "swing",
        showMethod: "fadeIn",
        timeOut: "5000"
    };

    // Bootbox language
    bootbox.setDefaults('locale', 'ro');

    // Tooltip/Popover set
    _body.tooltip({selector: '[data-toggle="tooltip"]'});
    _body.popover({selector: '[data-toggle="popover"]'});

    // LEFT BAR ACCORDION
    $('#nav-accordion').dcAccordion({
        eventType: 'click',
        autoClose: false,
        saveState: true,
        disableLink: false,
        speed: 'slow',
        showCount: false,
        autoExpand: true,
        classExpand: 'dcjq-current-parent'
    });

    $('.go-top').on('click', function () {
        $.scrollTo('#main-content', 400);
    });

    // sidebar dropdown menu auto scrolling
    $('#sidebar .sub-menu > a').click(function () {
        var o = ($(this).offset());
        diff = 250 - o.top;
        if (diff > 0)
            $("#sidebar").scrollTo("-=" + Math.abs(diff), 500);
        else
            $("#sidebar").scrollTo("+=" + Math.abs(diff), 500);
    });

    $(window).on('load', responsiveView);
    $(window).on('resize', responsiveView);

    $('.fa-bars').click(function () {
        if ($('#sidebar > ul').is(":visible") === true) {
            $('#main-content').css({
                'margin-left': '0px'
            });
            $('#sidebar').css({
                'margin-left': '-210px'
            });
            $('#sidebar > ul').hide();
            $("#container").addClass("sidebar-closed");
        } else {
            $('#main-content').css({
                'margin-left': '210px'
            });
            $('#sidebar > ul').show();
            $('#sidebar').css({
                'margin-left': '0'
            });
            $("#container").removeClass("sidebar-closed");
        }
    });

    // custom scrollbar
    $("#sidebar").niceScroll({
        styler: "fb",
        cursorcolor: "#e8403f",
        cursorwidth: '3',
        cursorborderradius: '10px',
        background: '#404040',
        spacebarenabled: false,
        cursorborder: ''
    });
    $("body").niceScroll({
        styler: "fb",
        cursorcolor: "#e8403f",
        cursorwidth: '6',
        cursorborderradius: '10px',
        background: '#404040',
        spacebarenabled: false,
        cursorborder: '',
        zindex: '1010',
    });

    // widget tools
    $('.panel .tools .fa-chevron-down').click(function () {
        var el = $(this).parents(".panel").children(".panel-body");
        if ($(this).hasClass("fa-chevron-down")) {
            $(this).removeClass("fa-chevron-down").addClass("fa-chevron-up");
            el.slideUp(200);
        } else {
            $(this).removeClass("fa-chevron-up").addClass("fa-chevron-down");
            el.slideDown(200);
        }
    });

    // by default collapse widget
    $('.panel .tools .fa-times').click(function () {
        $(this).parents(".panel").parent().remove();
    });

    // radio btn
    _body.on('click', '.label_radio.r_off', function () {
        var $el = $(this);

        if ($el.parent().hasClass('disabled')) {
            return false;
        }

        var $input = $el.children('input'),
            $checked_input = $('[name="' + $input.attr('name') + '"]:checked');

        $input.prop('checked', true);
        $el.removeClass('r_off').addClass('r_on');

        $checked_input.prop('checked', false);
        $checked_input.parent().removeClass('r_on').addClass('r_off');
    });
});