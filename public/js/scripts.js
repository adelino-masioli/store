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
$('.select2').select2();
//selected tabs
$(document).ready(function(){
    setTimeout(function(){
      $('.hidden-timeout').fadeOut();
    },2500)

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


    //search cep
    function clear_form_cep() {
        $("#address").val("");
        $("#district").val("");
        $("#city").val("");
        $("#state").val("");
     }

    //Quando o campo cep perde o foco.
    $("#zipcode").blur(function() {

        //Nova variável "cep" somente com dígitos.
        var cep = $(this).val().replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                $("#address").val("...");
                $("#district").val("...");
                $("#city").val("...");
                $("#state").val("...");

                //Consulta o webservice viacep.com.br/
                $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                    if (!("erro" in dados)) {
                        //Atualiza os campos com os valores da consulta.
                        $("#address").val(dados.logradouro);
                        $("#district").val(dados.bairro);
                        $("#city").val(dados.localidade);
                        $("#state").val(dados.uf);
                    } //end if.
                    else {
                        //CEP pesquisado não foi encontrado.
                        clear_form_cep();
                        toast('Importante', 'CEP não encontrado.', 'top-right', '#2594ff')
                    }
                });
            } //end if.
            else {
                //cep é inválido.
                clear_form_cep();
                toast('Importante', 'Formato de CEP inválido.', 'top-right', '#2594ff')
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            clear_form_cep();
        }
    });

});

function maskZipCode(){
    $('.zipcode').mask('99.999-999', {reverse: true});
}


function formSubmit(form){
    $(form).submit()
}

function masMoney(){
    $('.money').mask('#.##0,00', {reverse: true});
}

function addImage(image) {
    $('.editor').summernote('insertImage',image);
}