$(document).on('click', ".toggle-password", function() {
    $(this).parents('.password_toggle-eye').find('.bl-toggle-pass-img').toggleClass("password_toggle-eye-show");
    var input = $(this).parents('.password_toggle-eye').find('.in-pass-eye');
    if (input.attr("type") === "password") {
        input.attr("type", "text");
    }
    else {
        input.attr("type", "password");
    }
});

$(".profile-un-box .prof-btn_ed-sa").click(function() {
    // event.preventDefault();
    $(".profile-un-box .profile-a-btn").toggleClass('un-static-none');
    $(".profile-un-box .profile-un-static").toggleClass('un-static-none');
});

$(".profile-newsletter-box .prof-btn_active").click(function() {
    event.preventDefault();
    $(".profile-newsletter-box .profile-a-btn").toggleClass('newsletter_none');
    $(".profile-newsletter-box .newsletter_status").toggleClass('newsletter_none');

    $.ajax({
        type: 'GET',
        url: '/profile/update/news-latter',
        success: function(data){}
    });
});

$(document).on('click', ".ind-sel", function() {
    $(this).parents('.cst-select').toggleClass('show');
});
$(document).on('click', ".input-search", function() {
    $('.search-res-bl').toggleClass('abs-show');
});
$(document).on('click', ".ind-choose", function() {
    $(this).parents('.cst-choose').toggleClass('show');
});

$(document).on('click', ".clk_d", function() {
    var a = $(this).text();
    $(this).parents('.cst-select').find('.sssc').html(a);
    $(this).parents('.cst-select').removeClass('show');
    $(this).parents('.cst-select').find('.clk_d').removeClass('active');
    $(this).addClass('active');
});
$(document).on('click', ".clk_ch", function() {
    var a = $(this).text();
    $(this).parents('.cst-choose').find('.ssch').html(a);
    $(this).parents('.cst-choose').find('.ind-inp-choose').val(a);
    $(this).parents('.cst-choose').removeClass('show');
    $(this).parents('.cst-choose').find('.clk_ch').removeClass('active');
    $(this).addClass('active');
});
jQuery(function($){
    $(document).mouseup(function (e){ // событие клика по веб-документу
        var div = $(".cst-select.show"); // тут указываем ID элемента
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            div.removeClass('show'); // скрываем его
        }
    });
});
jQuery(function($){
    $(document).mouseup(function (ew){ // событие клика по веб-документу
        var div = $(".cst-choose.show"); // тут указываем ID элемента
        if (!div.is(ew.target) // если клик был не по нашему блоку
            && div.has(ew.target).length === 0) { // и не по его дочерним элементам
            div.removeClass('show'); // скрываем его
        }
    });
});
jQuery(function($){
    $(document).mouseup(function (ea){ // событие клика по веб-документу
        var div = $(".search-res-bl"); // тут указываем ID элемента
        if (!div.is(ea.target) // если клик был не по нашему блоку
            && div.has(ea.target).length === 0) { // и не по его дочерним элементам
            div.removeClass('abs-show'); // скрываем его
        }
    });
});
jQuery(function($){
    $(document).mouseup(function (e){ // событие клика по веб-документу
        var div = $(".drop-en-choose"); // тут указываем ID элемента
        var arrb = $('.ind-choose img');
        if (!div.is(e.target) // если клик был не по нашему блоку
            && div.has(e.target).length === 0) { // и не по его дочерним элементам
            div.removeClass('show'); // скрываем его
            arrb.removeClass('sel-active');
        }
    });
});

$(document).ready(function() {
    $(".cst-cls_mj").mCustomScrollbar({
        scrollButtons:{
            enable:true
        }
    });
});

$(document).on('click', ".section__t-sell", function() {
    $(this).parents('.pos-rel').find('.section__t-sell').toggleClass('show');
    $(this).parents('.pos-rel').find('.dropdown-menu').toggleClass('show');
});

/*$('.slick_m').slick({
  slidesToShow: 5,
  slidesToScroll: 1,
  arrows: true,
  infinite: false,
  centerMode: false,
  responsive: [
    {
      breakpoint: 991,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
  ]
});*/
$(document).ready(function() {
  $(".slick_m").mCustomScrollbar({
    axis:"x",
    theme:"dark-thick",
    autoExpandScrollbar:true,
    advanced:{autoExpandHorizontalScroll:true},
    updateOnContentResize:true,
    scrollbarPosition: 'outside',
    scrollInertia: 200
  });
});
$(window).on("load",function(){
    $(".slick-list").mCustomScrollbar();
});


$(document).ready(function() {
    $(".cst-cls_mj").mCustomScrollbar({
        scrollButtons:{
            enable:true
        }
    });
});

$(document).ready(function() {
    $(".cst-mm").mCustomScrollbar({
        scrollButtons:{
            enable:true
        }
    });
});

$(document).ready(function() {
    var height = $('.header').find('.container').height();
    $('.header').css('height', height);
});

// Слайдер
// var $carousel = $('.slick_m').slick({
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     dots: false,
//     infinite: false,
//     prevArrow: $('.slick-prev'),
//     nextArrow: $('.slick-next'),

//   });
// // Скролл
// $(window).on("load",function(){
//     $(".slick-list").mCustomScrollbar();
// });

// $(".slick_m").mCustomScrollbar({
//     axis:"x" // horizontal scrollbar
// });

// Слайдер
var $carousel = $('.slick').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  dots: false,
  infinite: false,
  prevArrow: $('.slick-prev'),
  nextArrow: $('.slick-next'),

});

// $carousel.on('wheel', (function(e) {
//   e.preventDefault();

//   if (e.originalEvent.deltaY < 0) {
//     $(this).slick('slickNext');
//   } else {
//     $(this).slick('slickPrev');
//   }
// }));

function setCookie(name, value) {
    document.cookie = name + "="+ value +"; path=/; max-age=2592000";
}

function getCookie(name) {
    let matches = document.cookie.match(new RegExp(
        "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
    ));
    return matches ? decodeURIComponent(matches[1]) : undefined;
}

function deleteCookie(name, value) {
    document.cookie = name + "="+ value +"; path=/; max-age=-1";
}

function generateUUID() { // Public Domain/MIT
    var d = new Date().getTime();
    if (typeof performance !== 'undefined' && typeof performance.now === 'function'){
        d += performance.now(); //use high-precision timer if available
    }
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
}

console.log(getCookie('user'));

if(getCookie('user') == undefined){
    setCookie('user', generateUUID());
}

$(document).on('change', '.filter-tag', function (event){
    event.preventDefault();

    $.ajax({
        url: "/filter",
        type: 'POST',
        dataType: 'JSON',
        data: $('#filter-form').serialize(),    // <-- Added data property
        success: function(data) {
            $('.search__results').html(data.html)
        },
        error: function(data) {
            console.log(data);
            alert("Oh no!");
        }
    });
});

$(document).on('click', '.pr-img-edit', function (){
    $('#avatar').trigger('click');
})

$(document).on('change', '#avatar', function (){
    $('#form-avatar').submit();
})

function setCurrency (currency){
    if(getCookie('currency') != undefined){
        deleteCookie('currency', getCookie('currency'));
    }
    setCookie('currency', currency);

    location.reload();
}

function loadGame (gameID, title, image)
{
    $('#banner-res-game').attr('src', image);
    $('#title-res-game').html(title);
    $('#result-product-home').html('');
    $('.section__t-sell').trigger('click');
    $.ajax({
        type: 'GET',
        url: '/load/game?game=' + gameID,
        success: function(data){
            $('#result-product-home').append(data.html);
        }
    });
}

function validation ()
{
    var check = true;

    if($('.input-method').val().length == 0) {
        check = false;
    }

    if($('.input-email').val().length == 0)
        check = false;

    if($('.contact-input').val().length == 0)
        check = false;

    if($('.payment-method').val().length == 0)
        check = false;

    if($('.required-check:checked').length < 1)
        check = false;

    return check;
}

$(document).on('change', '.required-input', function (){
    if(validation()) $('.btn-checkout').addClass('success-check');
})

$(document).on('submit', '#form-check', function (){
    $('.input-block-1').removeClass('error-input');
    $('.input-block-2').removeClass('error-input');
    $('.input-block-3').removeClass('error-input');
    $('.input-block-4').removeClass('error-input-check');

    if($('.input-method').val().length == 0) {
        $('.input-block-1').addClass('error-input');
    }

    if($('.input-email').val().length == 0)
        $('.input-block-3').addClass('error-input');

    if($('.contact-input').val().length == 0)
        $('.input-block-2').addClass('error-input');

    if($('.payment-method').val().length == 0)
        $('.option-pay-method').addClass('error-input');

    if($('.required-check-1:checked').length < 1)
        $('.input-block-4').addClass('error-input-check');

    if (!validation()){
        var top = $('.cont-title-b').offset().top;
        //анимируем переход на расстояние - top за 1500 мс
        $('body,html').animate({scrollTop: top}, 1500);
        return false;

    }
})

$(document).ready(function(){
    $(document).on("click",".btn-anchor", function (event) {
        //отменяем стандартную обработку нажатия по ссылке
        event.preventDefault();

        //забираем идентификатор бока с атрибута href
        var id  = $(this).attr('href'),

            //узнаем высоту от начала страницы до блока на который ссылается якорь
            top = parseFloat($(id).offset().top) - 100;

        //анимируем переход на расстояние - top за 500 мс
        $('body,html').animate({scrollTop: top}, 500);
    });
});

$(document).on('click', '.option-pay-method', function (){
    $('.payment-method').val($(this).attr('data-pay'));
    if(validation()) $('.btn-checkout').addClass('success-check');
});

$(document).on('input', '.search-input', function (){
    // $(".cst-cls_mj-search").mCustomScrollbar("destroy");
    $('#result-item-search').html('');

    $.ajax({
        type: 'GET',
        url: '/search/product?q=' + $(this).val(),
        beforeSend: function() {
            // $(".cst-cls_mj-search").mCustomScrollbar("destroy"); //Destroy
        },
        success: function(data){
            $('#result-item-search').html(data.html);
            $('#result-item-search-mobile').html(data.html);
            $(".cst-cls_mj-search").mCustomScrollbar({
                scrollButtons:{
                    enable:true
                }
            });
        },
        // complete: function () {
        //     $(".cst-cls_mj-search").mCustomScrollbar({
        //         scrollButtons:{
        //             enable:true
        //         }
        //     });
        // }
    });
})

$(document).on('submit', '.form-add-cart', function (event){
    event.preventDefault();

    $('.btn-continue-shop-modal').attr('href', '/shop?game='+$(this).find('button').attr('data-game'));

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),    // <-- Added data property
        success: function(data) {
            $('.cont-checkouts-box').html(data.html);

            if($('.count-cart').length > 0){
                $('.count-cart').html(data.count);
            }else{
                $('.cart-bl a span').append(`<div class="count-cart montserrat">1</div>`);
                $('#cart').attr('data-bs-target', '#modal-cart');
            }

            if(data.count > 0)
                $('#modal-cart').modal('show');
            else {
                $('#modal-cart-empty').modal('show');
                $('#cart').attr('data-bs-target', '#modal-cart-empty');
            }
        },
        error: function(data) {
            console.log(data);
            alert("Oh no!");
        }
    });
});

$(document).on('change', '.product-option', function (){
    var amount = parseInt($('.total-amount').text());
    var old_amount = parseInt($('.old-total-amount').text());
    if($(this).prop('checked')) {
        amount += parseInt($(this).attr('data-amount'));
        $('.total-amount').html(amount);

        old_amount += parseInt($(this).attr('data-amount'));
        $('.old-total-amount').html(old_amount);
        console.log('check');
    }else {
        amount -= parseInt($(this).attr('data-amount'));
        $('.total-amount').html(amount);

        old_amount -= parseInt($(this).attr('data-amount'));
        $('.old-total-amount').html(old_amount);
    }
});

function showPageMyOrder ()
{
    var pageNum = parseInt($('.page-number').val()) + 1;
    $('.page-number').val(pageNum);
    var productShow = pageNum * 3;
    for (var i=0;i<productShow;i++){
        $('.cont-checkout-item:eq('+i+')').css('display', '');
    }
}

function validateEmail(email) {
    var pattern  = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return pattern .test(email);
}

$(document).on('input', '#subscribe-email', function (){
    if(validateEmail($(this).val()))
        $('.subscribe-btn').attr('disabled', false);
})

$(document).on('submit', '.form-subscribe', function (event){
    event.preventDefault();

    $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        dataType: 'JSON',
        data: $(this).serialize(),    // <-- Added data property
        success: function(data) {
            $('.successfully-subscribed').css('display', '');
            setTimeout(function (){
                $('.successfully-subscribed').css('display', 'none');
            }, 5000);
        },
        error: function(data) {
            console.log(data);
            alert("Oh no!");
        }
    });
});

$(document).on('click', '.search-view-btn', function (event){
    event.preventDefault();

    location = $(this).attr('href')+'?q='+$('.search-input').val();
})

if(window.location.hash == "#game-list"){
    var firstVisit = true;
    $(window).scroll(function() {
        if (firstVisit) {
            window.scrollTo(0, 0);
            firstVisit = false;

            var  top = parseFloat($('#game-list').offset().top) - 100;
            $('body,html').animate({scrollTop: top}, 500);
        }
    });
}

$(document).on('input', '.password-check', function (){
    checkPassword($(this))
})

function checkPassword(form) {
    var password = form.val(); // Получаем пароль из формы
    var s_letters = "qwertyuiopasdfghjklzxcvbnm"; // Буквы в нижнем регистре
    var b_letters = "QWERTYUIOPLKJHGFDSAZXCVBNM"; // Буквы в верхнем регистре
    var digits = "0123456789"; // Цифры
    var specials = "!@#$%^&*()_-+=\|/.,:;[]{}"; // Спецсимволы
    var is_s = false; // Есть ли в пароле буквы в нижнем регистре
    var is_b = false; // Есть ли в пароле буквы в верхнем регистре
    var is_d = false; // Есть ли в пароле цифры
    var is_sp = false; // Есть ли в пароле спецсимволы
    for (var i = 0; i < password.length; i++) {
        /* Проверяем каждый символ пароля на принадлежность к тому или иному типу */
        if (!is_s && s_letters.indexOf(password[i]) != -1) is_s = true;
        else if (!is_b && b_letters.indexOf(password[i]) != -1) is_b = true;
        else if (!is_d && digits.indexOf(password[i]) != -1) is_d = true;
        else if (!is_sp && specials.indexOf(password[i]) != -1) is_sp = true;
    }
    var rating = 0;
    var text = "";
    if (is_s) rating++; // Если в пароле есть символы в нижнем регистре, то увеличиваем рейтинг сложности
    if (is_b) rating++; // Если в пароле есть символы в верхнем регистре, то увеличиваем рейтинг сложности
    if (is_d) rating++; // Если в пароле есть цифры, то увеличиваем рейтинг сложности
    if (is_sp) rating++; // Если в пароле есть спецсимволы, то увеличиваем рейтинг сложности
    /* Далее идёт анализ длины пароля и полученного рейтинга, и на основании этого готовится текстовое описание сложности пароля */
    if (password.length < 6 && rating < 3) text = "Simple";
    else if (password.length < 6 && rating >= 3) text = "Average";
    else if (password.length >= 8 && rating < 3) text = "Average";
    else if (password.length >= 8 && rating >= 3) text = "Complicated";
    else if (password.length >= 6 && rating == 1) text = "Simple";
    else if (password.length >= 6 && rating > 1 && rating < 4) text = "Average";
    else if (password.length >= 6 && rating == 4) text = "Complicated";
    $('.pass-str').html(text);
    // alert(text); // Выводим итоговую сложность пароля
    // return false; // Форму не отправляем
}

$(document).on('click', ".hide_p", function() {
    $(this).parents('.parent_block_t').find('.hide_p').addClass('open_p');
    $(this).parents('.parent_block_t').find('.hide_p').removeClass('hide_p');
    $(this).parents('.parent_block_t').find('.parent_box').slideDown();
});
$(document).on('click', ".open_p", function() {
    $(this).parents('.parent_block_t').find('.open_p').addClass('hide_p');
    $(this).parents('.parent_block_t').find('.open_p').removeClass('open_p');
    $(this).parents('.parent_block_t').find('.parent_box').slideUp();
});

$(document).on('click', ".hide_c", function() {
    $(this).parents('.box-togle_cont').find('.hide_c').addClass('open_c');
    $(this).parents('.box-togle_cont').find('.hide_c').removeClass('hide_c');
    $(this).parents('.box-togle_cont').find('.child-box_m').slideDown();
});
$(document).on('click', ".open_c", function() {
    $(this).parents('.box-togle_cont').find('.open_c').addClass('hide_c');
    $(this).parents('.box-togle_cont').find('.open_c').removeClass('open_c');
    $(this).parents('.box-togle_cont').find('.child-box_m').slideUp();
});
