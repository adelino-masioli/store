@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Relatórios
        @endslot
        @slot('small')
            Informe os filtros abaixo
        @endslot
        @slot('link')
            Relatório de pedidos
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{route('orders-financial')}}" onclick="localStorage.clear();" class="btn btn-sm bg-aqua margin-r-5 btn-flat"><i class="fa fa-list"></i> Listagem de Pedidos</a>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.messages.messages_register')
                            </div>


                            <div class="col-md-6">
                                <div class="nav-tabs-custom">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist" id="tabs">
                                        <li role="presentation" class="active"><a href="#quote" aria-controls="quote" role="tab" data-toggle="tab">Relatório de Pedidos</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="quote">


                                            <form class="form-horizontal" method="post" action="{{route('order-financial-report-filter')}}">
                                                {{ csrf_field() }}
                                                <div class="form-group">
                                                    <label for="date_begin" class="col-sm-3 control-label">Data inicial</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" id="date_begin"  name="date_begin" placeholder="Data inicial">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="date_end" class="col-sm-3 control-label">Data final</label>
                                                    <div class="col-sm-9">
                                                        <input type="date" class="form-control" id="date_end"  name="date_end" placeholder="Data final">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="customer_name" class="col-sm-3 control-label">Nome do cliente</label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="form-control" id="customer_name"  name="customer_name" placeholder="Nome do cliente">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="user" class="col-sm-3 control-label">Atendente</label>
                                                    <div class="col-sm-9">
                                                        @if(isset($users))
                                                            <select class="form-control select2" id="user" name="user_id" style="width: 100%;">
                                                                <option  value="" selected>Selecione</option>
                                                                @foreach($users as $user)
                                                                    <option  value="{{$user->id}}">{{$user->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="status_id" class="col-sm-3 control-label">Status</label>
                                                    <div class="col-sm-9">
                                                        @if(isset($status))
                                                            <select class="form-control select2" id="status_id" name="status_id" style="width: 100%;">
                                                                <option  value="" selected>Selecione</option>
                                                                @foreach($status as $statu)
                                                                    <option  value="{{$statu->id}}">{{$statu->status}}</option>
                                                                @endforeach
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-offset-2 col-sm-10">
                                                        <button type="submit" class="btn btn-danger">Executar filtro</button>
                                                        <button type="reset" onclick="$('.select2').val(null).trigger('change');" class="btn btn-default">Limpar filtros</button>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
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
    </script>
@endpush
