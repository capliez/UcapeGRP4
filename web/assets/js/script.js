$(document).ready(function(){

    $('.btn-login').click(function () {
        var btn = $(this);
        btn.button('loading'), setTimeout(function () {
            btn.button('reset')
        }, 3000)
    });


});