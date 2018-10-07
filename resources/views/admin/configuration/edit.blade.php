@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Configuração
        @endslot
        @slot('small')
            Editando a configuração: {{$configuration->name}}
        @endslot
        @slot('link')
            Edição de configuração
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.configuration.partials.menu')
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
                                        <li role="presentation" class="active"><a href="#category" aria-controls="category" role="tab" data-toggle="tab">Configuração</a></li>
                                        <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Logo</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="category">
                                            <form action="{{route('configuration-update')}}" method="post" class="panels" id="formsubmit">
                                                <input type="hidden" name="id" value="{{$configuration->id}}">
                                                @include('admin.configuration.partials.form')
                                            </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="images">@include('admin.configuration.partials.image')</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


@include('admin.midia.modal')

@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            $('.editor').summernote({
                lang: 'pt-BR',
                height: 200,
                minHeight: 200,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['paragraph']]
                ]
            });

            maskZipCode();
        });
    </script>
@endpush
