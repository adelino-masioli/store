$(document).ready(function($) {
    var Body = $('body');
    Body.addClass('preloader-site');
});

$(window).on('load', function() {
    $('.preloader-wrapper').fadeOut();
    $('body').removeClass('preloader-site');
});

function toast(heading, text, position, color){
    $.toast({
        heading: heading,
        text: text,
        position: position,
        stack: false,
        loaderBg: color
    })
}