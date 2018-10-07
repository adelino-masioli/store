@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Configurações
        @endslot
        @slot('small')
            Minhas configurações
        @endslot
        @slot('link')
            Minhas configurações
        @endslot
    @endcomponent


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                @include('admin.messages.messages_register')
            </div>

            <div class="col-md-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Dados da empresa</a></li>
                    </ul>

                    <div class="col-md-12">
                        <div class="callout callout-info">
                            <p>Falta pouco! Favor completar o cadastro abaixo para continuar.</p>
                        </div>
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form action="{{route('complete-registration-store')}}" method="post" class="panels" id="formsubmit">

                                @include('admin.configuration.partials.formcomplete')

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger flat">Salvar e continuar</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.tab-pane -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

    </section>
    <!-- /.content -->

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
