let VUFORIAS;

deleteVuforia = object => {

    const vuforiaId = $(object).data('action-id');
    $(object).prop('disabled', true);

    bootbox.prompt('Scrie "STERGE" pentru a confirma acțiunea', function(result) {
        if ('STERGE' === result)
        {
            $.ajax({
                url: 'vuforia/delete/' + vuforiaId,
                type: 'DELETE',
                success: function(r) {
                    const _pos = VUFORIAS.fnGetPosition($(object).closest('tr').get(0));
                    VUFORIAS.fnDeleteRow(_pos);
                    VUFORIAS.fnDraw(false);
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

$(function() {
    VUFORIAS = $('#table-vuforia').dataTable({
        'aaSorting': [[0, 'desc']],
        'oLanguage': {
            'sSearch': 'Caută:',
            'sEmptyTable': 'Nu mai există etichete!',
            'sInfo': 'Afișează _START_ până la _END_ din _TOTAL_ intrări',
            'sInfoEmpty': 'Afișează 0 intrări',
            'sInfoFiltered': '(din totalul de _MAX_ intrări)'
        },
        'aLengthMenu': [[5, 10, 15, 20, -1], [5, 10, 15, 20, 'Tot']],
        'iDisplayLength': 5,
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }]
    });

    $('.dataTables_filter input').addClass("form-control");
    $('.dataTables_length select').addClass("form-control");
});