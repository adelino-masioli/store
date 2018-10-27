<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button class="btn btn-sm bg-green btn-flat create-new-quote" type="button" style="@if(Cart::total() == 0) display: block @else display: none @endif"><i class="fa fa-plus-circle"></i> Clique aqui para criar um Novo Orçamento</button>
        </div>
    </div>
</div>


<div class="quote-form" style="@if(Cart::total() > 0) display: block @else display: none @endif">
    @include('admin.contact.partials.form_quote_item')
</div>


<div class="row show-itens-cart">
    <div class="col-md-12">
        <ul class="timeline list-results-orders"></ul>
        <div class="list-results-orders-no-results"></div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {
            getDataQuote();
            getTableItens();
        });


        function showHideFormQuote(showform){
            if(showform === 1){
                $('.create-new-quote').hide();
                $('.quote-form').fadeToggle();
                $('#discount').val('');
                $('.discount').html('0,00');
                $('#description').val('');
            }else{
                $('.quote-form').css('display', 'none');
                $('.create-new-quote').fadeToggle();
            }
        }
        $('.create-new-quote').click(function () {
            showHideFormQuote(1);
            getTableItens();
            getDataQuote();
        });

        function getDataQuote(){
            var listQuotes = '';
            var listQuotesNoResults = '';
            var url = "{{route('contact-quote-get', [$contact->id])}}";

            $.get(url, function( result ) {
                if(result) {
                    var json_str = result;
                    //loop on json
                    json_str.forEach(function (data) {
                        var phone = data.phone != null ? data.phone : "N/A";
                        var email = data.email != null ? data.email : "N/A";

                        listQuotes +=
                            '            <li>\n' +
                            '                <legend>' + data.name + ' <small>' + data.created_at + '</small></legend>\n' +
                            '                <p>\n' +
                            '                    <strong>Telefone:</strong> ' + phone + '<br/>\n' +
                            '                    <strong>Email:</strong> ' + email + '<br/>\n' +
                            '                    <strong>Valor:</strong> R$ ' + data.total + '<br/>\n' +
                            '                    <strong>Atendido por:</strong> ' + data.user.name + '<br/>\n' +
                            '                    <strong>Status:</strong> ' + data.status.status + '\n' +
                            '                </p>\n' +
                            '                <button onclick="sendEmail(&apos;' + window.btoa(data.id) + '&apos;);" class="btn btn-outline-secondary btn-flat btn-xs"><i class="fa fa-send-o"></i> Enviar email</button>\n' +
                            '                <button onclick="downloadPDF(&apos;' + window.btoa(data.id) + '&apos;);" class="btn btn-outline-secondary btn-flat btn-xs"><i class="fa fa-file-pdf-o"></i> Exportar PDF</button>\n' +
                            '                <button onclick="confirmMofifyStatus(&apos;new&apos;, &apos;' + data.id + '&apos;);" class="btn bg-yellow btn-flat btn-xs"><i class="fa fa-check-circle"></i> Novo</button>\n' +
                            '                <button onclick="confirmMofifyStatus(&apos;proccess&apos;, &apos;' + data.id + '&apos;);" class="btn bg-green btn-flat btn-xs"><i class="fa fa-check-circle"></i> Ganho</button>\n' +
                            '                <button onclick="confirmMofifyStatus(&apos;canceled&apos;, &apos;' + data.id + '&apos;);" class="btn bg-red btn-flat btn-xs"><i class="fa fa-close"></i> Perdido</button>\n' +
                            '            </li>';
                    });
                    $('.list-results-orders').html(listQuotes);
                }else{
                    listQuotesNoResults += '<p class="text-center"><i class="fa fa-exclamation-triangle"></i> Nenhum resultado</p>';
                    $('.list-results-orders-no-results').html(listQuotesNoResults);
                }
            });
        }

        function confirmMofifyStatus(action, id) {
            var bgbtn = action == 'proccess' || action == 'new'  ? 'bg-aqua' : 'bg-red';
            confirmAction('Tem certeza que deseja executar esta operação?', modifyStatus, [action, id], bgbtn);
        }
        function modifyStatus(action, id) {
            var urlRemove = '{{route('quote-status')}}';
            var vDatadiscount = {
                _token:$('input[name=_token]').val(),
                status:action,
                order_id:id
            };
            $.post(
                urlRemove,
                vDatadiscount,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante',  response.response, 'top-right', '#2dff2e')
                        $('#modal-quote').modal('hide');
                        getDataQuote();
                    } else {
                        toast('Importante',  response.response, 'top-right', '#ff0000')
                    }
                }
            );
        }
        function downloadPDF(id) {
            var url_pdf = "{{route('contact-quote-pdf', null)}}";
            window.location = url_pdf+'/'+id;
        }

        function sendEmail(id) {
            preloadWait(1, '<i class="fa fa-2x fa-exclamation-triangle"></i> <p>Aguarde, enviando email...</p>');

            setTimeout(function () {
                var urlRemove = '{{route('quote-send-email')}}';
                var vDatadiscount = {
                    _token:$('input[name=_token]').val(),
                    order_id:id
                };
                $.post(
                    urlRemove,
                    vDatadiscount,
                    function (response) {
                        if (response.status === 1) {
                            toast('Importante',  response.response, 'top-right', '#2dff2e')
                            preloadWait(2);
                        } else {
                            toast('Importante',  response.response, 'top-right', '#ff0000')
                        }
                    }
                );
            }, 600);
        }
    </script>
@endpush