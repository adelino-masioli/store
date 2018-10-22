@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Cliente
        @endslot
        @slot('small')
            Editando o cliente: {{$customer->name}}
        @endslot
        @slot('link')
            Edição de cliente
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.customer.partials.menu')
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
                                        <li role="presentation" class="active"><a href="#singletab" aria-controls="singletab" role="tab" data-toggle="tab">Cliente</a></li>
                                        <li role="presentation"><a href="#images" aria-controls="images" role="tab" data-toggle="tab">Avatar</a></li>
                                    </ul>

                                    <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="singletab">
                                            <form action="{{route('customer-update')}}" method="post" class="panels" id="formsubmit">
                                                <input type="hidden" name="id" value="{{$customer->id}}">
                                                @include('admin.customer.partials.form')
                                            </form>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="images">@include('admin.customer.partials.image')</div>
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
            maskPhone();
        });
    </script>
@endpush
