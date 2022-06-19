$( document ).ready(function() {
//     $("#form-button").click(
//     function(){
//         if ($('input[name="name"]').val().length>1 && $('input[name="phone"]').val().length>8){
//         }
//     }
// )
});

function sendAjaxForm(result_form, form, url) {
    $.ajax({
        url:     url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+form).serialize(),  // Сериализуем объект
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            console.log('Success');
        },
        error: function(response) { // Данные не отправлены
            result = $.parseJSON(response);
            console.log('Fail');
        },
        complete:function(){
            $('#apply').each(function(){
                this.reset();   //Here form fields will be cleared.
            });
            $('#phone').siblings('.custom-placeholder').css('display', 'none');
            $('#phone').removeClass('filling');
            $("#thankYouModal").modal('show');
        }
    });

}
