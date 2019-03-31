// Callable functions
$(document).off('click', '[data-action]').on('click', '[data-action]', function(e) {
    if (true !== e.handled) {
        var action_name = window[$(this).data('action')];

        if (typeof action_name == 'function') {
            action_name(this, e);
        }

        e.handled = true;
    }
});

function reset_pass(obj)
{
    $(obj).prop('disabled', true);

    $.ajax({
        url: '/parola',
        type: 'POST',
        data: {email_reset: $('#email_reset').val()},
        success: function(r){
            remove_errors();
            $('#reset-modal').modal('hide');

            toastr['success'](r.message, r.title);
        },
        error: function(r){
            handle_errors(r.responseJSON);
        },
        complete: function(r) {
            $(obj).prop('disabled', false);
        }
    });
}

function remove_errors()
{
    var _formGroups = $('.form-group.has-error');

    _formGroups.children('.help-block').remove();
    _formGroups.removeClass('has-error');
}

function handle_errors(errors)
{
    remove_errors();

    if (errors.hasOwnProperty('success') && !errors['success'])
    {
        toastr['error']('', errors['message']);
    } else {
        for (var el in errors)
        {
            if (errors.hasOwnProperty(el))
            {
                var $el = $('#' + el);
                $el.closest('.form-group').addClass('has-error');
                $el.after('<p class="help-block">' + errors[el] + '</p>');
            }
        }
    }
}

$(function() {
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

    // Tooltip/Popover set
    _body.tooltip({ selector: '[data-toggle="tooltip"]' });
    _body.popover({ selector: '[data-toggle="popover"]' });
});