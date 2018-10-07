@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Orçamento
        @endslot
        @slot('small')
            Visualizando o orçamento: #COD{{$quote->id}}
        @endslot
        @slot('link')
            Detalhes do orçamento
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{route('quotes')}}" onclick="localStorage.clear();" class="btn btn-sm bg-aqua margin-r-5 btn-flat"><i class="fa fa-list"></i> Listagem de Orçamentos</a>
                        <a href="javascript:void(0)" class="btn btn-sm bg-yellow btn-flat" onclick="formSubmit('#formsubmit');"><i class="fa fa-check-circle"></i> Atualizar orçamento</a>
                        <a href="{{route('quote-convert', [base64_encode($quote->id)])}}" class="btn btn-sm bg-green btn-flat"><i class="fa fa-dollar"></i> Converter em pedido</a>
                        <a href="{{route('quote-cancel', [base64_encode($quote->id)])}}" class="btn btn-sm bg-red btn-flat"><i class="fa fa-trash"></i> Cancelar</a>
                    </div>

                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-12">
                                @include('admin.messages.messages_register')
                            </div>


                            <div class="col-md-12">
                                <div class="nav-tabs-custom">
                                    <!-- Nav tabs -->
                                    <ul class="nav nav-tabs" role="tablist" id="tabs">
                                        <li role="presentation" class="active"><a href="#quote" aria-controls="quote" role="tab" data-toggle="tab">Detalhes do Orçamento</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="quote">
                                            <form action="{{route('quote-update')}}" method="post" class="panels" id="formsubmit">
                                                <input type="hidden" name="id" value="{{$quote->id}}">
                                                @include('admin.order.partials.quoteshow')
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
