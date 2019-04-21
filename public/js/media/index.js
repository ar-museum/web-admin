var MEDIAS;

$(function() {
    MEDIAS = $('#all-media').dataTable({
        'aaSorting': [[0, 'desc']],
        'oLanguage': {
            'sInfo': 'Afiseaza _START_ pana la _END_ din _TOTAL_ intrari',
            'sSearch': 'Cauta:',
            'sEmptyTable': 'Nu mai exista media!',
            'sInfoFiltered': '(filtrat din totalul de _MAX_ intrari)'
        },
        'aLengthMenu': [[5, 10, 20, 50, 100, 200, -1], [5, 10, 20, 50, 100, 200, 'Tot']],
        'iDisplayLength': 10,
        // Disable sorting on the no-sort class
        'aoColumnDefs': [{
            'bSortable': false,
            'aTargets': ['no-sort']
        }]
    });

    $('.dataTables_filter input').addClass("form-control"); // modify table search input
    $('.dataTables_length select').addClass("form-control"); // modify table per page dropdown
});
