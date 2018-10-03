@extends('admin.layouts.app')

@section('content')

@component('admin.components.contentheader')
    @slot('title')
        Suporte
    @endslot
    @slot('small')
        Listagem de Suporte
    @endslot
    @slot('link')
        Suporte
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
                            <table class="table table-bordered table-condensed table-hover table-striped" id="supports-table" style="width: 100%;">
                                <thead>
                                <tr>
                                    <th class="hidden-xs col-md-1 text-center">ID</th>
                                    <th class="hidden-xs col-md-1 text-center">AÇÃO</th>
                                    <th class="col-md-5 text-center">ASSUNTO DO CHAMADO</th>
                                    <th class="col-md-1 text-center">BAIXAR</th>
                                    <th class="col-md-1 text-center">EXTENSÃO</th>
                                    <th class="col-md-2 text-center">DATA</th>
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
        $('#supports-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{route('datatable-supports')}}',
            columns: [
                {data: 'id', name: 'id', orderable: false, searchable: false, className: 'text-center'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-center'},
                {data: 'title', name: 'title'},
                {data: 'file', name: 'file', orderable: false, searchable: false, className: 'text-center'},
                {data: 'extension', name: 'extension', className: 'text-center text-uppercase', orderable: false, searchable: false},
                {data: 'created_at', name: 'created_at'},
                {data: 'status', name: 'status', className: 'text-center', orderable: false, searchable: false},
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
