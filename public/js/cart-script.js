$(document).ready(function() {
    $('.cart-item').each(function(){
        var price = $(this).find('.price .value').text();
        $(this).find('.price .value-new').html(price);
        getOverallSum();
    });
    $('.cart-item')
    // QUANTITY INPUTS SCRIPTS
    $('.minus').click(function () {
        var quantity_input = $(this).parent().find('input[name="quantity"]');
        var count = parseInt(quantity_input.val()) - 1;
        count = count < 1 ? 1 : count;
        quantity_input.val(count);
        quantity_input.change();
        let id = $(this).siblings('#id').val();
        if(quantity_input.val()>=1){
            decreaseItemQuantity(id);
        }
        return false;
    });
    $('.plus').click(function () {
        var quantity_input = $(this).parent().find('input[name="quantity"]');
        quantity_input.val(parseInt(quantity_input.val()) + 1);
        quantity_input.change();
        let id = $(this).siblings('#id').val();
        increaseItemQuantity(id);
        return false;
    });
    $('[name="quantity"]').change(function () {
        var price_new;
        var quantity = $(this).val();
        var price = $(this).parents('.cart-item').find('.price .value').text();
        price_new = toNumberWithoutDelimiters(price)*quantity;
        $(this).parents('.cart-item').find('.price .value-new').html(toNumberWithDelimiters(price_new));
        getOverallSum();
    });
    //END OF QUANTITY INPUTS SCRIPTS

    //CART SCRIPTS

    $('.delete').click( function () {
        var item = $(this).parents('.cart-item');
        item.addClass('hidden');
        let id = $(this).parents('.cart-item').find('#id').val();
        removeFromCart(id);
        setTimeout(function () {
            item.remove();
            getOverallSum();
            cartIsEmpty();
        }, 350);
    });

    function cartIsEmpty(){
        if ($('.cart-items-block').children().length == 0){
            $('.cart-block').remove();
            $('.cart').append('<div class="empty-cart-block">\n' +
                '                        <p class="empty-cart-message">Ваша корзина пуста</p>\n' +
                '                        <div class="btn-container">\n' +
                '                            <a href="/catalog" class="btn">Перейти в каталог</a>\n' +
                '                        </div>\n' +
                '                    </div>');
        }
    }
    function getOverallSum(){
        var sum = 0;
        $('.price .value-new').each(function(){
            sum += toNumberWithoutDelimiters($(this).text());  // Or this.innerHTML, this.innerText
        });
        $('.overall .value').html(toNumberWithDelimiters(sum));
    }
    function toNumberWithoutDelimiters(x) {
        return parseInt(x.toString().replace(/([^0-9])/g, ""));
    }
    function toNumberWithDelimiters(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
    }
    //END OF CART SCRIPTS

    $('#to_cart_submit').click(function(){
        addToCart()
    });
    function addToCart(){
        let id = $("#to_cart input[name=product_id]").val();
        let quantity = $("#to_cart input[name=quantity]").val();
        $.ajax({
            type:'POST',
            url:'/cart/add',
            data: {
                id: id,
                quantity: quantity,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data) {
                $('.popup-window.add-success .name').html(data.name);
                showPopUp('add-success');
                getCartItemsQuantity();
            },
            error:function () {

            }
        });
    }
    function removeFromCart(id){
        $.ajax({
            type:'POST',
            url:'/cart/remove',
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data) {
                showPopUp('delete-success');
                getCartItemsQuantity();
            },
            error:function () {

            }
        });
    }
    function increaseItemQuantity(id){
        $.ajax({
            type:'POST',
            url:'/cart/increase',
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data) {
                showPopUp('quantity-change-success');
            },
            error:function () {

            }
        });

    }
    function decreaseItemQuantity(id){
        $.ajax({
            type:'POST',
            url:'/cart/decrease',
            data: {
                id: id,
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data) {
                showPopUp('quantity-change-success');
            },
            error:function () {

            }
        });

    }
    function getCartItemsQuantity(){
        $.ajax({
            type:'GET',
            url:'/cart/getQuantity',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success:function(data) {
                console.log(data.quantity);
                if(!$('.header .cart-btn').find('.quantity').length !== 0){
                    $('.header .cart-btn').append(
                        '<div class="quantity">\n' +
                        '    <p class="text"></p>\n' +
                        '</div>')
                }
                if(data.quantity === 0){
                    $('.header .cart-btn .quantity').remove();
                }
                let quantity = $('.header .cart-btn .quantity .text');
                quantity.html(data.quantity);
            },
            error:function () {

            }
        });
    }



//POPUPS SCRIPTS
    function showPopUp(uniqueClass){
        // popUpHideIfShown(id);
        if($('.' + uniqueClass).hasClass('active')){
            let thisPopUp = $('.popup-window.' + uniqueClass).clone().appendTo('body');
            popUpHide(thisPopUp);
        }
        else{
            let thisPopUp = $('.popup-window.' + uniqueClass).addClass('active');
            popUpHide(thisPopUp);
        }
    }
    $('.popup-window #added-close').click(function () {
        let currentPopUp = $(this).parents('.popup-window');
        currentPopUp.addClass('hidden');
        setTimeout(function () {
            currentPopUp.removeClass('active').removeClass('hidden');
        }, 600);
    });
    function popUpHide(thisPopUp){
        var timeout_set = setTimeout(function () {
            thisPopUp.addClass('hidden');
            setTimeout(function () {
                thisPopUp.removeClass('active').removeClass('hidden');
            }, 600);
        }, 4000);
    }
//END POPUPS SCRIPTS
});

