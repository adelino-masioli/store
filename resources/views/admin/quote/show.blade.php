@extends('admin.layouts.app')

@push('styles')
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Orçamento
        @endslot
        @slot('small')
            Visualizando o orçamento: #{{$quote->id}}
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
                        <a href="{{route('quotes')}}" onclick="localStorage.clear();" class="btn btn-sm bg-aqua margin-r-5 btn-flat">Listagem de Orçamentos</a>
                        <a href="javascript:void(0)" class="btn btn-sm bg-yellow btn-flat" onclick="formSubmit('#formsubmit');">Atualizar o status desse orçamento</a>
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
                                            <form action="{{route('quote-update-status')}}" method="post" class="panels" id="formsubmit">
                                                <input type="hidden" name="id" value="{{$quote->id}}">
                                                @include('admin.quote.partials.show')
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
    <script src="{{ asset('plugins/summernote/dist/summernote.min.js') }}"></script>
    <script src="{{ asset('plugins/summernote/dist/lang/summernote-pt-BR.min.js') }}"></script>
    <script src="{{ asset('plugins/mask/jquery.mask.min.js') }}"></script>

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

            //money
            masMoney();
        });
    </script>
@endpush
