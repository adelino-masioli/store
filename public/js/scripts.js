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

//selected tabs
$(document).ready(function(){
    $('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
        localStorage.setItem('activeTab', $(e.target).attr('href'));
    });
    var activeTab = localStorage.getItem('activeTab');
    if(activeTab){
        $('#tabs a[href="' + activeTab + '"]').tab('show');
    }


    $('.checkbox').iCheck({
        checkboxClass: 'icheckbox_minimal-grey',
        radioClass   : 'iradio_minimal-grey'
    });


    $('.select2').select2();

    $(":file").filestyle();
});


function formSubmit(form){
    $(form).submit()
}