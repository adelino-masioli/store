@extends('admin.layouts.app')

@push('styles')
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Suporte
        @endslot
        @slot('small')
            Detalhes o chamado: {{$support->name}}
        @endslot
        @slot('link')
            Detalhes do chamado
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="{{route('supports')}}" onclick="localStorage.clear();" class="btn btn-sm bg-aqua margin-r-5 btn-flat"><i class="fa fa-list"></i> Listagem de Chamados de Suporte</a>
                        <a href="{{route('support-close', [base64_encode($support->id)])}}" class="btn btn-sm bg-red btn-flat" ><i class="fa fa-check-circle"></i> Fechar Chamado</a>
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
                                        <li role="presentation" class="active"><a href="#singletabs" aria-controls="singletabs" role="tab" data-toggle="tab">Suporte</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="singletabs">
                                            @include('admin.support.partials.show')
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
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/dist/lang/summernote-pt-BR.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.editor').summernote({
                lang: 'pt-BR',
                height: 100,
                minHeight: 100,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['paragraph']]
                ]
            });

        });
    </script>
@endpush
