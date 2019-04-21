var EXPOSITIONS;

function delete_exposition(obj)
{
    var _expositionId = $(obj).data('action-id');
    $(obj).prop('disabled', true);

    bootbox.prompt('Scrie "STERGE" pentru a confirma actiunea', function(result) {
        if ('STERGE' === result)
        {
            $.ajax({
                url: '/exposition/' + _expositionId + '/sterge',
                type: 'POST',
                success: function(r) {
                    var _pos = EXPOSITIONS.fnGetPosition($(obj).closest('tr').get(0));
                    EXPOSITIONS.fnDeleteRow(_pos);
                    EXPOSITIONS.fnDraw(false);
                    toastr['success']('', r.message);
                },
                error: function(r) {
                    handle_errors(r.responseJSON);
                }
            });
        }

        $(obj).prop('disabled', false);
    });
}

$(function() {
    EXPOSITIONS = $('#all-expositions').dataTable({
        'aaSorting': [[0, 'desc']],
        'oLanguage': {
            'sInfo': 'Afiseaza _START_ pana la _END_ din _TOTAL_ intrari',
            'sSearch': 'Cauta:',
            'sEmptyTable': 'Nu mai exista expozitii!',
            'sInfoFiltered': '(filtrat din totalul de _MAX_ intrari)'
        },
        'aLengthMenu': [[25, 50, 100, 200, -1], [25, 50, 100, 200, 'Tot']],
        'iDisplayLength': 25,
        // Disable sorting on the no-sort class
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }]
    });

    $('.dataTables_filter input').addClass("form-control"); // modify table search input
    $('.dataTables_length select').addClass("form-control"); // modify table per page dropdown
});
