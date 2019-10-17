$(function() {
    $('.select2').select2();

    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

    $('.datatable-responsive-row-control').DataTable({
        'scrollX': true,
        responsive: {
            details: {
                type: 'column',
                target: 'tr'
            }
        },
        columnDefs: [
            {
                className: 'control',
                orderable: false,
                targets:   0
            },
            { 
                width: "100px",
                targets: [2]
            },
            { 
                orderable: true,
                targets: [2]
            }
        ],
        order: [1, 'asc']
     });   
});

