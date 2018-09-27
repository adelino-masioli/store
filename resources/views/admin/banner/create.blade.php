@extends('admin.layouts.app')

@push('styles')
    <link href="{{ asset('plugins/summernote/dist/summernote.css') }}" rel="stylesheet">
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Banner
        @endslot
        @slot('small')
            Cadastro de banner
        @endslot
        @slot('link')
            Nova banner
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.banner.partials.menu')
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
                                        <li role="presentation" class="active"><a href="#singletabs" aria-controls="singletabs" role="tab" data-toggle="tab">Banner</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="singletabs">
                                            <form action="{{route('banner-store')}}" method="post" class="panels" id="formsubmit"  enctype="multipart/form-data">
                                                @include('admin.banner.partials.form')
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
                height: 70,
                minHeight: 70,
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
