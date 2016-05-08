$(document).ready(function(){
    $('.nav').nav();
    $('#menu-toggle').click(function(){
        if($('#menu').hasClass('open')){
            $('#menu').removeClass('open');
            $('#menu-toggle').removeClass('open');
        }else{
            $('#menu').addClass('open');
            $('#menu-toggle').addClass('open');
        }
    });

});

$(window).load(function() {
    // Animate loader off screen
    $(".se-pre-con").fadeOut("slow");;
});

$(window).scroll(function() {
    if ($(this).scrollTop() > 1){
        $('header').addClass("sticky");
    }
    else{
        $('header').removeClass("sticky");
    }
});