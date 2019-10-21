$(function() {
    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });
    $('.select2').select2();

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
                targets: [3]
            },
            { 
                orderable: true,
                targets: [3]
            }
        ],
        order: [1, 'asc']
    });

    $.ajax({
            type:'POST',
            url: $('#getAdmin').val(),
            dataType:"JSON",
            success: function(data) {
                $('#Admin').select2({
                    placeholder: 'Pick Admin',
                    data: data
                });
            }
        });

     $.ajax({
            type:'POST',
            url: $('#getAdminCampus').val(),
            dataType:"JSON",
            success: function(data) {
                $('#Admincampus').select2({
                    placeholder: 'Pick Admin campus',
                    data: data
                });
            }
        });

     $.ajax({
            type:'POST',
            url: $('#getDosen').val(),
            dataType:"JSON",
            success: function(data) {
                $('#Dosen').select2({
                    placeholder: 'Pick Dosen',
                    data: data
                });
            }
        });

     $.ajax({
            type:'POST',
            url: $('#getMahasiswa').val(),
            dataType:"JSON",
            success: function(data) {
                $('#Mahasiswa').select2({
                    placeholder: 'Pick Mahasiswa',
                    data: data
                });
            }
        });

    $("#log-form").validate({
        ignore: 'input[type=hidden], .select2-search__field', // ignore hidden fields
        errorClass: 'validation-error-label',
        successClass: 'validation-valid-label',
        highlight: function(element, errorClass) {
            $(element).removeClass(errorClass);
            if ($(element).parent().hasClass('has-success')){
                $(element).parent().removeClass('has-success');
                $(element).parent().addClass('has-error');
            }
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass(errorClass);

            if ($(element).parent().hasClass('has-error')){
                $(element).parent().removeClass('has-error');
                $(element).parent().addClass('has-success');
            }
            
        },

        errorPlacement: function(error, element) {
            
            if (element.parent().hasClass('has-success')) {
                element.parent().removeClass('has-success');
            }
            element.parent().addClass('has-error');

            if (element.parents('div').hasClass("checker") || element.parents('div').hasClass("choice") || element.parent().hasClass('bootstrap-switch-container') ) {
                if(element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                    error.appendTo( element.parent().parent().parent().parent() );
                }
                 else {
                    error.appendTo( element.parent().parent().parent().parent().parent() );
                }
            }
            else if (element.parents('div').hasClass('checkbox') || element.parents('div').hasClass('radio')) {
                error.appendTo( element.parent().parent().parent() );
            }

            else if (element.parents('div').hasClass('has-feedback') || element.hasClass('select2-hidden-accessible')) {
                error.appendTo( element.parent() );
            }
            else if (element.parents('label').hasClass('checkbox-inline') || element.parents('label').hasClass('radio-inline')) {
                error.appendTo( element.parent().parent() );
            }
            else if (element.parent().hasClass('uploader') || element.parents().hasClass('input-group')) {
                error.appendTo( element.parent().parent() );
            }

            else {
                error.insertAfter(element);
            }
        },
        validClass: "validation-valid-label",
        success: function(label, element) {
            if (label.parent().hasClass('has-error')) {
                label.parent().removeClass('has-error');
            }
            label.parent().addClass('has-success');
            label.addClass("validation-valid-label").text("Successfully")
        },
        rules: {
            Admin: {
                required: true
            },
            Admincampus: {
                required: true
            },
            Dosen: {
                required: true
            },
            Mahasiswa: {
                required: true
            }

        }
        // submitHandler: function () {
            
        //     var post_data = new FormData($('#pengaduan-form')[0]);
            
        //     $.ajax({ 
        //             url : $('#pengaduan-form').attr("action"),
        //             type: "POST",
        //             data : post_data,
        //             contentType: false,
        //             cache: false,
        //             processData:false,
        //             dataType:"JSON",
        //             success: function(data) {
                      
        //             },
        //             error: function(data){
        //                notif('Error',data.statusText,'bg-danger');
        //             }
        //         });

        // }
    });
    
});
