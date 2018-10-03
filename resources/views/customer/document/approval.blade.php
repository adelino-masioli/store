@extends('admin.layouts.app')

@section('content')

@component('admin.components.contentheader')
    @slot('title')
        Documentos para Aprovação
    @endslot
    @slot('small')
        Listagem de Documentos para Aprovação
    @endslot
    @slot('link')
        Documentos para Aprovação
    @endslot
@endcomponent

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                            @include('admin.messages.messages_register')
                        </div>

                        <div class="col-md-12">
                            <table class="table table-bordered table-condensed table-hover table-striped" id="customer-documents-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th class="hidden-xs col-md-1 text-center">ID</th>
                                    <th class="hidden-xs col-md-1 text-center">AÇÃO</th>
                                    <th class="col-md-2 text-center">DESCRIÇÃO</th>
                                    <th class="col-md-1 text-center">TIPO</th>
                                    <th class="col-md-1 text-center">BAIXAR</th>
                                    <th class="col-md-1 text-center">EXTENSÃO</th>
                                    <th class="col-md-2 text-center">CRIADO</th>
                                    <th class="col-md-2 text-center">MODIFICADO</th>
                                    <th class="hidden-xs col-md-1 text-center">STATUS</th>
                                </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
</section>




@endsection
@push('scripts')
    <script>
        $('#customer-documents-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('datatable-customer-documents', [1])}}',
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: false, className: 'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                {data: 'name', name: 'documents.name'},
                {data: 'type', name:'type'},
                {data: 'file', name: 'file', orderable: false, searchable: false, className: 'text-center'},
                {data: 'extension', name: 'extension', className: 'text-center text-uppercase'},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'status', name: 'status', className: 'text-center'},
            ],
            lengthMenu: [[8,10, 20, 30, -1], [8, 10, 20, 30, "Todos"]],
            language: {
                        "sEmptyTable": "Nenhum registro encontrado",
                        "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                        "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                        "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                        "sInfoPostFix": "",
                        "sInfoThousands": ".",
                        "sLengthMenu": "_MENU_ resultados por página",
                        "sLoadingRecords": "Carregando...",
                        "sProcessing": "Processando...",
                        "sZeroRecords": "Nenhum registro encontrado",
                        "sSearch": "Pesquisar",
                        "oPaginate": {
                        "sNext": "Próximo",
                            "sPrevious": "Anterior",
                            "sFirst": "Primeiro",
                            "sLast": "Último"
                    },
                        "oAria": {
                        "sSortAscending": ": Ordenar colunas de forma ascendente",
                            "sSortDescending": ": Ordenar colunas de forma descendente"
                    }
                }
        });
    </script>
@endpush
