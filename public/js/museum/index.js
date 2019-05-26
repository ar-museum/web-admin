let MUSEUMS;

delete_museum = object => {

    const museumId = $(object).data('action-id');
    $(object).prop('disabled', true);

    bootbox.prompt('Scrie "STERGE" pentru a confirma acțiunea', function(result) {
        if ('STERGE' === result)
        {
            $.ajax({
                url: 'museum/delete/' + museumId,
                type: 'DELETE',
                success: function(r) {
                    const _pos = MUSEUMS.fnGetPosition($(object).closest('tr').get(0));
                    MUSEUMS.fnDeleteRow(_pos);
                    MUSEUMS.fnDraw(false);
                    toastr['success']('', r.message);
                },
                error: function(r) {
                    handle_errors(r.responseJSON);
                }
            });
        }

        $(object).prop('disabled', false);
    });
}

$('.timepicker-24').timepicker({
    autoclose: true,
    minuteStep: 1,
    showSeconds: true,
    showMeridian: false
});