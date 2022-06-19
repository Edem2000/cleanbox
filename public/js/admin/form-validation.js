
$(document).ready(function() {
  $( "#admin_product_form .submit" ).click(function( event ) {
    if($('textarea[name=description_ru]').val().length==0 || $('textarea[name=description_uz]').val().length==0 || $('textarea[name=description_en]').val().length==0){
      $('.note').css('display', 'block');
    }
  });
  $( "#admin_news_form .submit" ).click(function( event ) {
    if($('textarea[name=content_ru]').val().length==0 || $('textarea[name=content_uz]').val().length==0 || $('textarea[name=content_en]').val().length==0){
      $('.note').css('display', 'block');
    }
  });
    $.validator.addMethod('regex', function(value, element, param) {
            return this.optional(element) ||
                value.match(typeof param == 'string' ? new RegExp(param) : param);
        },
        'Please enter a value in the correct format.');

    // $('form[id="admin_product_form"]').validate({
    //     rules: {
    //         name_ru: {
    //             required: true,
    //         },
    //         name_en: {
    //             required: true,
    //         },
    //         name_uz: {
    //             required: true,
    //         },
    //         description_ru: {
    //             required: true,
    //         },
    //         description_en: {
    //             required: true,
    //         },
    //         description_uz: {
    //             required: true,
    //         },
    //     },
    //     messages: {
    //       name_ru: {
    //         required: 'Это обязательное поле',
    //       },
    //       name_en: {
    //         required: 'Это обязательное поле',
    //       },
    //       name_uz: {
    //         required: 'Это обязательное поле',
    //       },
    //       description_ru: {
    //         required: 'Это обязательное поле',
    //       },
    //       description_en: {
    //         required: 'Это обязательное поле"',
    //       },
    //       description_uz: {
    //         required: 'Это обязательное поле',
    //       },
    //
    //     },
    //     submitHandler: function(form) {
    //         form.submit();
    //     }
    // });
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
                // regex: /^\+998 \([0-9]{2}\)[0-9]{3}-[0-9]{2}-[0-9]{2}$/,
            },
        },
        messages: {
            name: 'Введите имя',
            phone: {
                required: 'Введите номер',
                // regex: 'Проверьте введенный номер телефона',
            },

        },
        submitHandler: function() {
            sendAjaxForm('result_form', 'apply', 'action_ajax_form.php');
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



});
