@extends('admin.layouts.app')

@push('styles')
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Meu usuário
        @endslot
        @slot('small')
            {{$user->name}}
        @endslot
        @slot('link')
            Edição de perfil de usuário
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <a href="javascript:void(0)" class="btn btn-sm bg-yellow btn-flat" onclick="formSubmit('#formsubmit');"><i class="fa fa-check-circle"></i> Salvar alterações</a>
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
                                        <li role="presentation" class="active"><a href="#singletab" aria-controls="singletab" role="tab" data-toggle="tab">Meu usuário</a></li>
                                        <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Avatar</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="singletab">
                                            <form action="{{route('user-update')}}" method="post" class="panels" id="formsubmit">
                                                <input type="hidden" name="id" value="{{$user->id}}">
                                                @include('admin.user.partials.form')
                                            </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="images">@include('admin.user.partials.image')</div>
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
                height: 70,
                minHeight: 70,
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
