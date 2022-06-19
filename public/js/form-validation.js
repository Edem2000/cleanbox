
$(document).ready(function() {
    $.validator.addMethod('regex', function(value, element, param) {
            return this.optional(element) ||
                value.match(typeof param == 'string' ? new RegExp(param) : param);
        },
        'Please enter a value in the correct format.');

    $('form[id="checkout_form"]').validate({
        rules: {
            customer: {
                required: true,
                regex: /[A-Za-zА-Яа-я]+/,
            },
            phone: {
                required: true,
                regex: /\([0-9]{2}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}/,
            },
        },
        messages: {
            customer: {
                required: 'Введите имя',
                regex: 'Имя должно состоять из букв',
            },
            phone: {
                required: 'Введите номер',
                regex: 'Проверьте введенный номер телефона',
            },

        },
        submitHandler: function(form) {
            $('#submit-container').addClass('blocked');
            $('.form-btn').prop('disabled', true);
            form.submit();
        }
    });
    $("#phone").mask("(00) 000-00-00");
    $('#phone').focus(function() {
        $('.phone-container').addClass('before');
    }).blur(function() {
        if($(this).val().length===0){
            $('.phone-container').removeClass('before');
        }
    });
});


$(document).ready(function() {
    $.validator.addMethod('regex', function(value, element, param) {
            return this.optional(element) ||
                value.match(typeof param == 'string' ? new RegExp(param) : param);
        },
        'Please enter a value in the correct format.');

    $('#apply').validate({
        rules: {
            name: 'required',
            phone: {
                required: true,
              regex: /\([0-9]{2}\)\s[0-9]{3}-[0-9]{2}-[0-9]{2}/,
            },
            email: {
              email: true,
            }
        },
        messages: {
            name: 'Введите имя',
            phone: {
                required: 'Введите номер',
                // regex: 'Проверьте введенный номер телефона',
            },
            email: {
              email: 'Проверьте email',
            }

        },
        submitHandler: function() {
          sendContactForm();
        }
    });
    // $('#phone').focus(function() {
    //     $(this).attr('placeholder', '').addClass('filling');
    //     $(this).siblings('.custom-placeholder').css('display', 'block');
    // }).blur(function() {
    //     $(this).attr('placeholder', 'Номер телефона +998');
    //     if($(this).val().length==0){
    //         $(this).siblings('.custom-placeholder').css('display', 'none');
    //         $(this).removeClass('filling');
    //     }
    // });

    $("#phone").mask("(10) 000-00-00", {'translation': {
        9: {pattern: /[9]/},
        1: {pattern: /[9,3]/},
    }
    })


});
