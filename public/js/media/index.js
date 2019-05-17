var MEDIAS;

function delete_media(obj)
{
    var _mediaId = $(obj).data('action-id');
    $(obj).prop('disabled', true);

    bootbox.prompt('Scrie "STERGE" pentru a confirma actiunea', function(result) {
        if ('STERGE' === result)
        {
            $.ajax({
                url: 'media/delete/' + _mediaId,
                type: 'DELETE',
                success: function(r) {
                    var _pos = MEDIAS.fnGetPosition($(obj).closest('tr').get(0));
                    MEDIAS.fnDeleteRow(_pos);
                    MEDIAS.fnDraw(false);
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
    MEDIAS = $('#all-photo').dataTable({
        'aaSorting': [[0, 'desc']],
        'oLanguage': {
            'sInfo': 'Afiseaza _START_ pana la _END_ din _TOTAL_ intrari',
            'sSearch': 'Cauta:',
            'sEmptyTable': 'Nu mai exista fotografii!',
            'sInfoFiltered': '(filtrat din totalul de _MAX_ intrari)'
        },
        'aLengthMenu': [[5, 10, 20, 50, 100, 200, -1], [5, 10, 20, 50, 100, 200, 'Tot']],
        'iDisplayLength': 5,
        // Disable sorting on the no-sort class
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }]
    });

    $('.dataTables_filter input').addClass("form-control"); // modify table search input
    $('.dataTables_length select').addClass("form-control"); // modify table per page dropdown
});

$(function() {
    MEDIAS = $('#all-audio').dataTable({
        'aaSorting': [[0, 'desc']],
        'oLanguage': {
            'sInfo': 'Afiseaza _START_ pana la _END_ din _TOTAL_ intrari',
            'sSearch': 'Cauta:',
            'sEmptyTable': 'Nu mai exista fotografii!',
            'sInfoFiltered': '(filtrat din totalul de _MAX_ intrari)'
        },
        'aLengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'Tot']],
        'iDisplayLength': 5,
        // Disable sorting on the no-sort class
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }]
    });

    $('.dataTables_filter input').addClass("form-control"); // modify table search input
    $('.dataTables_length select').addClass("form-control"); // modify table per page dropdown
});

$(function() {
    MEDIAS = $('#all-video').dataTable({
        'aaSorting': [[0, 'desc']],
        'oLanguage': {
            'sInfo': 'Afiseaza _START_ pana la _END_ din _TOTAL_ intrari',
            'sSearch': 'Cauta:',
            'sEmptyTable': 'Nu mai exista fotografii!',
            'sInfoFiltered': '(filtrat din totalul de _MAX_ intrari)'
        },
        'aLengthMenu': [[5, 10, 20, -1], [5, 10, 20, 'Tot']],
        'iDisplayLength': 5,
        // Disable sorting on the no-sort class
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }]
    });

    $('.dataTables_filter input').addClass("form-control"); // modify table search input
    $('.dataTables_length select').addClass("form-control"); // modify table per page dropdown
});
