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

var modalTemplate = '<div class="modal-dialog modal-lg" role="document">\n' +
        '  <div class="modal-content">\n' +
        '    <div class="modal-header">\n' +
        '      <div class="kv-zoom-actions btn-group">{toggleheader}{fullscreen}{borderless}{close}</div>\n' +
        '      <h6 class="modal-title">{heading} <small><span class="kv-zoom-title"></span></small></h6>\n' +
        '    </div>\n' +
        '    <div class="modal-body">\n' +
        '      <div class="floating-buttons btn-group"></div>\n' +
        '      <div class="kv-zoom-body file-zoom-content"></div>\n' + '{prev} {next}\n' +
        '    </div>\n' +
        '  </div>\n' +
        '</div>\n';

    // Buttons inside zoom modal
    var previewZoomButtonClasses = {
        toggleheader: 'btn btn-default btn-icon btn-xs btn-header-toggle',
        fullscreen: 'btn btn-default btn-icon btn-xs',
        borderless: 'btn btn-default btn-icon btn-xs',
        close: 'btn btn-default btn-icon btn-xs'
    };

    // Icons inside zoom modal classes
    var previewZoomButtonIcons = {
        prev: '<i class="icon-arrow-left32"></i>',
        next: '<i class="icon-arrow-right32"></i>',
        toggleheader: '<i class="icon-menu-open"></i>',
        fullscreen: '<i class="icon-screen-full"></i>',
        borderless: '<i class="icon-alignment-unalign"></i>',
        close: '<i class="icon-cross3"></i>'
    };

    // File actions
    var fileActionSettings = {
        zoomClass: 'btn btn-link btn-xs btn-icon',
        zoomIcon: '<i class="icon-zoomin3"></i>',
        dragClass: 'btn btn-link btn-xs btn-icon',
        dragIcon: '<i class="icon-three-bars"></i>',
        removeClass: 'btn btn-link btn-icon btn-xs',
        removeIcon: '<i class="icon-trash"></i>',
        indicatorNew: '<i class="icon-file-plus text-slate"></i>',
        indicatorSuccess: '<i class="icon-checkmark3 file-icon-large text-success"></i>',
        indicatorError: '<i class="icon-cross2 text-danger"></i>',
        indicatorLoading: '<i class="icon-spinner2 spinner text-muted"></i>'
    };

$(function() {

    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

    $('.select2').select2();

    $('.pickadate').pickadate({
        labelMonthNext: 'Next month',
        labelMonthPrev: 'Before month',
        labelMonthSelect: 'Pick another month',
        labelYearSelect: 'Pick another year',
        selectMonths: true,
        selectYears: 50,
        format: 'dd mmmm yyyy',
        formatSubmit: 'yyyy-mm-dd',
        monthsFull: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        weekdaysShort: ['Min', 'Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab'],
    });

    $('#ImageFile').fileinput({
        browseLabel: 'Browse',
        browseIcon: '<i class="icon-file-plus"></i>',
        uploadIcon: '<i class="icon-file-upload2"></i>',
        removeIcon: '<i class="icon-cross3"></i>',
        layoutTemplates: {
            icon: '<i class="icon-file-check"></i>',
            modal: modalTemplate
        },
        initialCaption: "No file Selected",
        previewZoomButtonClasses: previewZoomButtonClasses,
        previewZoomButtonIcons: previewZoomButtonIcons,
            fileActionSettings: fileActionSettings
    });
    
    $.ajax({
        type:'POST',
        url: $('#getrole').val(),
        dataType:"JSON",
        success: function(data) {
            $('#Roleid').select2({
                placeholder: 'Pick role',
                data: data
            });
        }
    });

    $.ajax({
        type:'POST',
        url: $('#getdept').val(),
        dataType:"JSON",
        success: function(data) {
            $('#Deptid').select2({
                placeholder: 'Pick department',
                data: data
            });
        }
    });

    $.validator.addMethod("letteronly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
    });

    $.validator.addMethod( "extensionImage", function( value, element, param ) {
    param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g";
    return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
    });

    $.validator.addMethod( "extensionDoc", function( value, element, param ) {
    param = typeof param === "string" ? param.replace( /,/g, "|" ) : "pdf";
    return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
    });

    $.validator.addMethod('filesize', function (value, element, param) {
    return this.optional(element) || (element.files[0].size <= param)
    });

    $("#dokumen-form").validate({
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
            Email: {
                required: true,
                email: true
            },
            Fullname: {
                required: true,
                letteronly: true,
            },
            Deptid: {
                required: true
            },
            Roleid: {
                required: true
            },
            Telephone: {
                required: true,
                number: true,
                minlength: 5,
                maxlength: 15
            }
        },
        messages: {
            Email: {
                required: "Insert your email",
                email: "Your email must be in the format name@domain.com"
            },
            Fullname: {
                required: "Insert your name",
                letteronly: "Insert alphabet only"
            },
            Telephone: {
                required: "Insert your Telephone",
                minlength: jQuery.validator.format(" {0} character needed"),
                maxlength: jQuery.validator.format(" {0} character maximum"),
                number: "Only number"
            },
            Deptid: {
                required: "Pick Department"
            },
            Roleid: {
                required: "Pick Role Type"
            },
        },
        submitHandler: function () {
            
            var post_data = new FormData($('#dokumen-form')[0]);
            
            $.ajax({ 
                    url : $('#dokumen-form').attr("action"),
                    type: "POST",
                    data : post_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType:"JSON",
                    success: function(data) {
                        console.log(data);
                      if (data.code == 200)
                      {
                        eval(data.aksi);
                      }else if (data.code == 366){
                        $( "#dokumen-form" ).validate().showErrors({
                            "Email": data.message
                          });
                        notif('Error',data.message,'bg-danger');
                      }else if (data.code == 368){
                        $( "#dokumen-form" ).validate().showErrors({
                            "Fullname": data.message
                          });
                        notif('Error',data.message,'bg-danger');
                      }else{
                        notif('Error',data.message,'bg-danger');
                      }
                    },
                    error: function(data){
                       notif('Error',data.statusText,'bg-danger');
                    }
                });

        }
    });
    

});


function showModal(target,index,tipe){
    var urlx = '';
    var datax = '';
    if (tipe == 'add')
    {
      urlx = target;
      datax= {};
    }else{
      urlx = target;
      datax = {id:index};
    }
   
    $.post(urlx, datax , function(mod) {
        $('#tampilModal').html(mod);
        $('#modalPortal').modal({show: true , backdrop : true , keyboard: true});
    });
}

$(document).on("click", "#submit-dokumen", function () {
    $("#dokumen-form").validate({
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
        rules: {
            Password1: "required",
            Password2: {
              equalTo: "#Password1"
            }
        },
        messages: {
            Password1: {
                required: "Insert New Password"
            },
            Password2: {
                required: "Repeat Password",
                equalTo: "Please enter the same password"
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
        submitHandler: function () {
            
            var post_data = new FormData($('#dokumen-form')[0]);

            $.ajax({ 
                    url : $('#dokumen-form').attr("action"),
                    type: "POST",
                    data : post_data,
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType:"JSON",
                    success: function(data) {
                    console.log(data);
                      if (data.code == 200)
                      {
                        window.location.reload();
                      }else{
                        notif('Error',data.message,'bg-danger');
                      }
                    },
                    error: function(data){
                       notif('Error',data.statusText,'bg-danger');
                    }
                });

        }
    });
});