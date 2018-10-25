<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <button class="btn btn-sm bg-green btn-flat" type="button" data-toggle="modal" data-target="#modal-quote"><i class="fa fa-plus-circle"></i> Clique aqui para criar um Novo Orçamento</button>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-md-12">
        <ul class="timeline list-results-orders"></ul>
        <div class="list-results-orders-no-results"></div>
    </div>
</div>

<div class="modal fade" id="modal-quote">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Orçamento</h4>
            </div>
            <div class="modal-body">
                @include('admin.contact.partials.form_quote_item')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat"  onclick="confirmAction('Tem certeza que deseja cancelar este orçamento?', cancelOrder, [null], 'bg-red');">Cancelar</button>
                <button type="button" class="btn bg-aqua btn-flat" onclick="confirmAction('Tem certeza que deseja finalizar este orçamento?', finishOrder, [null], 'bg-aqua');">Confirmar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


@push('scripts')
    <script>
        $(document).ready(function () {
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
                            '                <button class="btn btn-outline-secondary btn-flat btn-xs"><i class="fa fa-send-o"></i> Enviar email</button>\n' +
                            '                <button   onclick="downloadPDF(&apos;' + window.btoa(data.id) + '&apos;);" class="btn btn-outline-secondary btn-flat btn-xs"><i class="fa fa-file-pdf-o"></i> Exportar PDF</button>\n' +
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
            //alert(window.atob(id));
            window.location = url_pdf+'/'+id;
        }
    </script>
@endpush