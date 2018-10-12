AOS.init();

$("a[href='#top']").click(function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    return false;
});
$("a[href='#go-quote-tab']").click(function() {
    $("html, body").animate({ scrollTop: $('#tabproduct').offset().top - 200 }, "slow");
    setTimeout(function () {
        $('#quote-tab').click();
    }, 100)
    return false;
});

$(document).scroll(function() {
    var y = $(this).scrollTop();
    if (y > 800) {
        $('#go-to-top').fadeIn();
    } else {
        $('#go-to-top').fadeOut();
    }
});

setTimeout(function () {
    $('.alert').fadeOut(500);
    $('.show-alert').html('');
}, 5000);

$(window).on('load', function(){
    $('#status').fadeOut();
    $('#preloader').delay(300).fadeOut('slow');
});

//only number
function onlyNumber(input) {
    $(input).on('keypress input', function() {
        var value = $(this).val();
        value = value.replace(/\D+/, '');
        $(this).val(value);
    });
}

//mask zipcode
function maskZipCode(){
    $('.zipcode').mask('99.999-999', {reverse: true});
}
//search cep
function clear_form_cep() {
    $("#address").val("");
    $("#district").val("");
    $("#city").val("");
    $("#state").val("");
}

$("#zipcode").blur(function() {

    //New variable "cep" only digitus.
    var cep = $(this).val().replace(/\D/g, '');

    //Verify if is true enter value
    if (cep != "") {

        //Regurar expression validade CEP
        var validacep = /^[0-9]{8}$/;

        //Format CEP validate
        if(validacep.test(cep)) {

            //Populate fields "..." waiting webservice.
            $("#address").val("...");
            $("#district").val("...");
            $("#city").val("...");
            $("#state").val("...");

            //Consult webservice viacep.com.br/
            $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                if (!("erro" in dados)) {
                    //Update inputs after consult
                    $("#address").val(dados.logradouro);
                    $("#district").val(dados.bairro);
                    $("#city").val(dados.localidade);
                    $("#state").val(dados.uf);
                } //end if.
                else {
                    //CEP searching not result
                    clear_form_cep();
                    toast('Importante', 'CEP não encontrado.', 'top-right', '#2594ff')
                }
            });
        } //end if.
        else {
            //CEP no valid.
            clear_form_cep();
            toast('Importante', 'Formato de CEP inválido.', 'top-right', '#2594ff')
        }
    } //end if.
    else {
        //Empty CEP clear inputs
        clear_form_cep();
    }
});

//mask money
function maskMoney(){
    $('.money').mask('#.##0,00', {reverse: true});
}

function maskPhone() {
    $('.phone').mask('99 9999-9999', {reverse: true});
}
function maskCellphone(input){
    jQuery(input)
        .mask("99 99999-9999")
        .focusout(function (event) {
            var target, phone, element;
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;
            phone = target.value.replace(/\D/g, '');
            element = $(target);
            element.unmask();
            if(phone.length > 10) {
                element.mask("99 99999-9999");
            } else {
                element.mask("99 9999-99999");
            }
        });
}