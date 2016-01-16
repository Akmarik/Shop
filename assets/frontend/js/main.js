$(function(){
    update_total();

    $('.buy').click(function(){
        var id = $(this).attr('product_id');
        var message = $(this).parent().find('.message');
        $.ajax({
            url: "/cart/add",
            type: 'POST',
            data: ({id: id }),
            success: function(data){
                if(data.total && data.info == '1'){
                    $(message).text('Товар успешно добавлен в корзину.').css({display: 'block'});
                    setTimeout(function(){$(message).fadeOut('fast')},2000);
                    $('#cart_total').text(data.total);
                }else if(data.info == '2'){
                    $(message).text('Что бы добавить товар, нужна авторизация').css({display: 'block'});
                    setTimeout(function(){$(message).fadeOut('fast')},2000);
                }else if(data.info == '3'){
                    $(message).text('Такой товар уже есть в корзине').css({display: 'block'});
                    setTimeout(function(){$(message).fadeOut('fast')},2000);
                }
            }
        });
    })

    $('.arrow_previous').click(function(){
        var arrow_previous = $(this).attr('arrow_previous');
        var block_count_cart = $(this).parent().find('.block_count_cart');
        var block_count_price = $(this).parent().parent().find('.cartPriceSpan1');

        $.ajax({
            url: "/cart/count_test",
            type: 'POST',
            data: ({arrow_previous: arrow_previous }),
            success: function(data){
                $(block_count_cart).text(data.total_count);
                $(block_count_price).text(data.total_price);
                update_total();
            }
        })
    });


    $('.arrow_next').click(function(){
        var arr_next = $(this).attr('arr_next');
        var block_count_cart = $(this).parent().find('.block_count_cart');
        var block_count_price = $(this).parent().parent().find('.cartPriceSpan1');

        $.ajax({
            url: "/cart/count_test",
            type: 'POST',
            data: ({arr_next: arr_next }),
            success: function(data){
                $(block_count_cart).text(data.total_count);
                $(block_count_price).text(data.total_price);
                update_total();
            }
        })
    });

    $('.deleteProduct').click(function(){

        var deleteProduct = $(this).attr('deleteProduct');
        var deleteElem = $(this).parent().parent();

        $.ajax({
            url: "/cart/deleteProduct",
            type: 'POST',
            data: ({deleteProduct: deleteProduct }),
            success: function(data){
                if(data.success){
                    $(deleteElem).remove();
                    update_total();
                    $('#cart_total').text(data.total);
                    if($('.cartPanel').length == 0){
                        $('.totalOrderInfo').remove(); //удалить кнопку оформить заказ

                    }
                }
            }
        })
    });

    function update_total(){
        var total = 0;
        $('.cartPriceSpan1').each(function(){
            total += Number($(this).text());
        });

        $('.totalPrice').text('Общая сумма: '+total+" руб.");
    }


    $('#order_delivery_type_courier').click(function(){
        document.getElementById('country').disabled = false;
        document.getElementById('street').disabled = false;
        document.getElementById('build').disabled = false;
        document.getElementById('flat_office').disabled = false;
        document.getElementById('orderTextarea').disabled = false;
    });

    $('#order_delivery_type_pickup_point').click(function(){
        document.getElementById('country').disabled = true;
        document.getElementById('street').disabled = true;
        document.getElementById('build').disabled = true;
        document.getElementById('flat_office').disabled = true;
        document.getElementById('orderTextarea').disabled = true;
    });


});