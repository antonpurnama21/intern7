$(function() {
    $('.datatable-responsive-row-control').DataTable({
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

