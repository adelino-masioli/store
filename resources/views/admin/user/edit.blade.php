@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Usuário
        @endslot
        @slot('small')
            Editando o usuário: {{$user->name}}
        @endslot
        @slot('link')
            Edição de usuário
        @endslot
    @endcomponent

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        @include('admin.user.partials.menu')
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
                                        <li role="presentation" class="active"><a href="#singletab" aria-controls="singletab" role="tab" data-toggle="tab">Usuário</a></li>
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
    <script>
        $(document).ready(function() {
            maskZipCode();
        });
    </script>
@endpush
