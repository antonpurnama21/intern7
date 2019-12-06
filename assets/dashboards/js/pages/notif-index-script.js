$(function() {

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
//<?php echo site_url('faculty/delete/') ?>


