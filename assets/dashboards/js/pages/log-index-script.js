$(function() {
    var listPengaduan = [];
    $.post($('#alamatList').val(), {}, function(resp){
        var result = JSON.parse(resp);
        $('.datatable-responsive-row-control').DataTable({
            data:result,
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
    
});
