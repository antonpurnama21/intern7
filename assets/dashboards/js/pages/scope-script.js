$(function() {

        $('.select2').select2();

        $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

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

        $.ajax({
            type:'POST',
            url: $('#getCategory').val(),
            dataType:"JSON",
            success: function(data) {
                $('#Categoryid').select2({
                    placeholder: 'Pick Category',
                    data: data
                });
            }
        });

        $.ajax({
            type:'POST',
            url: $('#getProject').val(),
            dataType:"JSON",
            success: function(data) {
                $('#Projectid').select2({
                    placeholder: 'Pick Project',
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
            Projectscope: {
                required: true,
                letteronly: true
            },
            Quantity: {
                required: true,
                number: true
            }
        },
        messages: {
            Projectscope: {
                required: "Insert Project Scope",
                letteronly: "Alphabet Only"
            },
            Quantity: {
                required: "Insert Quantity Requiretment",
                number: "Number Only"
            }
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
                            "Projectscope": data.message
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

function getData(target,id,tujuan)
  {
    $.post(target, {id:id} , function(resp) {
       var result = JSON.parse(resp);
       $('#'+tujuan).html('').select2({data: {id:null, text: null}});
       $('#'+tujuan).select2({
            placeholder: 'Silahkan pilih kota',
            data: result
        });
    });
  }