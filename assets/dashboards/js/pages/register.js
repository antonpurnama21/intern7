$(function() {

    $(".styled, .multiselect-container input").uniform({ radioClass: 'choice' });

    $.ajax({
        type:'POST',
        url: $('#getFaculty').val(),
        dataType:"JSON",
        success: function(data) {
            $('#Facultyid').select2({
                placeholder: 'Pick Faculty',
                data: data
            });
        }
    });

    $.ajax({
        type:'POST',
        url: $('#getUniv').val(),
        dataType:"JSON",
        success: function(data) {
            $('#Universityid').select2({
                placeholder: 'Pick University',
                data: data
            });
        }
    });

    $('.select2').select2();

    $.validator.addMethod("alphabetOnly", function(value, element) {
        return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
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
            Nim: {
                required: true,
                minlength: 5,
                maxlength: 15
            },
            Email: {
                required: true,
                email: true
            },
            Mobilephone: {
                required: true,
                minlength: 5,
                maxlength: 15,
                number: true
            },
            Universityid: {
                required: true
            },
            Facultyid: {
                required: true
            },
            Fullname: {
                required: true,
                alphabetOnly: true
            }
        },
        messages: {
            Email: {
                required: "Insert your email",
                email: "Your email must be in the format name@domain.com"
            },
            Nim: {
                required: "Insert your nim",
                minlength: jQuery.validator.format(" {0} character needed"),
                maxlength: jQuery.validator.format(" {0} character maximum")
            },
            Mobilephone: {
                required: "Insert your mobile phone",
                minlength: jQuery.validator.format(" {0} character needed"),
                maxlength: jQuery.validator.format(" {0} character maximum"),
                number: "Insert number only"
            },
            Universityid: {
                required: "Pick your university"
            },
            Facultyid: {
                required: "Pick your faculties"
            },
            Fullname: {
                required: "Insert your name",
                alphabetOnly: "Insert alphabet only"
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
                            "Email": data.message
                          });
                        notif('Error',data.message,'bg-danger');
                      }else if (data.code == 367){
                        $( "#dokumen-form" ).validate().showErrors({
                            "Nim": data.message
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