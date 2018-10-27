var base_url = $('meta[name=base-url]').attr("content");

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

function addImage(image) {
    $('.editor').summernote('insertImage',image);
}

//refresh datatable
function funcionRefreshDatatable(){
    table.ajax.reload();
}
//only number
function onlyNumber(input) {
    $(input).on('keypress input', function() {
        var value = $(this).val();
        value = value.replace(/\D+/, '');
        $(this).val(value);
    });
}

//submit forms
function functionSave(formid) {
    $(formid).ajaxForm({
        success: function (data) {
            if (data.status == 1) {
                //show success
                toast('Success', data.response, 'top-right', '#2594ff');
                //reset form
                if ($('#formreset').val() == 'reset') {
                    resetForm(formid);
                }
                //get data
                if ($('#getdata').val() == 'true') {
                    getData();
                    functionCancel();
                }
                if (data.redirect) {
                   setTimeout(function () {
                       window.location.replace(data.redirect);
                   }, 400);
                }
                return false;
            } else {
                if (data.status != 2 && data.status != 400) {
                    //show alert fail
                    toast('Error', data.error, 'top-right', '#ff0000');
                }else{
                    //show alert fail
                    toast('Error', formatErrors(data.error), 'top-right', '#ff0000');
                }
                return false;
            }
            return false;
        },
        error: function (data) {
            //show erro message and validations
            if( data.error){
                toast('Error', data.error, 'top-right', '#ff0000');
            }else{
                toast('Error', 'Contact support', 'top-right', '#ff0000');
            }
            return false;
        },
        type: 'post',
        dataType: 'json',
        url: $(formid).attr('action'),
        headers: {
            '_token': $('input[name="_token"]').attr('content'),
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).submit();
    return false;
}


//remove
function functionRemove(formid, url) {
    $(formid).ajaxForm({
        success: function (data) {
            if (data.status == 1) {
                //show success
                toast('Success', data.response, 'top-right', '#2594ff');
                //reset form
                if ($('#formreset').val() == 'reset') {
                    resetForm(formid);
                }
                if ($('#getdata').val() == 'true') {
                    getData();
                    functionCancel();
                }
                return false;
            } else {
                if (data.status != 2 && data.status != 400) {
                    //show alert fail
                    toast('Error', data.error, 'top-right', '#ff0000');
                }else{
                    //show alert fail
                    toast('Error', formatErrors(data.error), 'top-right', '#ff0000');
                }
                return false;
            }
            return false;
        },
        error: function (data) {
            //show erro message and validations
            if( data.error){
                toast('Error', data.error, 'top-right', '#ff0000');
            }else{
                toast('Error', 'Contact support', 'top-right', '#ff0000');
            }
            return false;
        },
        type: 'post',
        dataType: 'json',
        url: url,
        headers: {
            '_token': $('input[name="_token"]').attr('content'),
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    }).submit();
    return false;
}


//format error
function formatErrors(errorMsg) {
    var errors = errorMsg;
    //show messages
    for (var e in errors) {
        return errors[e];
    }
}
//reset form
function resetForm(form) {
    $(form).each(function () {
        this.reset();
    });
}
//scroll
function scrollToDiv(div){
    $("html, body").animate({
        scrollTop: $(div).offset().top
    }, 1000);
}

//shortcuts key
$(window).bind('keydown', function(event) {
    if (event.ctrlKey || event.metaKey) {
        switch (String.fromCharCode(event.which).toLowerCase()) {
            case 's':
                event.preventDefault();
                $('.key-save').click();
                break;
            case 'f':
                event.preventDefault();
                colsole.log('ctrl-f');
                break;
            case 'g':
                event.preventDefault();
                colsole.log('ctrl-g');
                break;
        }
    }
});

//confirm
function confirmAction(content, callback, args, bgbutton) {
    $.confirm({
        title: 'Confirmar!',
        content: content,
        animationBounce: 1.5,
        buttons: {
            cancel: {
                text: 'Não',
                btnClass: 'btn-default btn-flat',
                keys: ['enter', 'shift'],
                action: function(){
                    //$.alert('Something else?');
                }
            },
            confirm: {
                text: 'Sim',
                btnClass: bgbutton,
                keys: ['enter', 'shift'],
                action: function(){
                    callback.apply(this, args);
                }
            },
        }
    });
}

function preloadInitFc(div) {
    $(div).css('position', 'relative');
    $(div).html('<div class="preload-content" style="position:absolute;width:100%;height: 100%;background:#ffffff;text-align: center;padding: 30px;">Carregando...</div>');
}
function preloadEndFc(div) {
    $(div).css('position', 'relative');
    $('.preload-content').fadeOut();
    $('.preload-content').html('');
}

function preloadWait(act, content){
    let backgroundimage = base_url+'/assets/images/bg-transp-black.png';
    if(act === 1){
        $("<div class='preload-wait'>"+content+"</div>").css({
            position: "fixed",
            width: "100%",
            height: "100%",
            top: 0,
            left: 0,
            'background-image': "url('"+backgroundimage+"')",
            'background-repeat': "repeat"
        }).appendTo($(".wrapper").css("position", "relative"));
    }else{
        $('.preload-wait').fadeOut();
    }
}

//detect no action page
activityTimeout = setTimeout(inActive, 5 * 60 * 1000);

function resetActive(){
    preloadWait(2);
    clearTimeout(activityTimeout);
    activityTimeout = setTimeout(inActive, 5 * 60 * 1000);
}
function inActive(){
    preloadWait(1, '<i class="fa fa-2x fa-exclamation-triangle"></i> <p>Caso não haja interação com o sistema, você será deslogado a qualquer momento.</p>');
    setTimeout(function(){
        exitSys()
    }, 10 * 60 * 1000)
}
$(document).bind('mousemove', function(){resetActive()});


//confirm reload page
// window.onbeforeunload = function(event){
//     return "Bye";
// }