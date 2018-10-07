@extends('admin.layouts.app')

@push('styles')
@endpush
@section('content')
    @component('admin.components.contentheader')
        @slot('title')
            Configuração
        @endslot
        @slot('small')
            Minhas configuraçãos: {{$my_config->name}}
        @endslot
        @slot('link')
            Minhas configuraçãos
        @endslot
    @endcomponent


    <!-- Main content -->
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                @include('admin.messages.messages_register')
            </div>

            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="box box-info">
                    <div class="box-body box-profile">
                        @if(defineUploadPath('brands', null).'/'.$my_config->brand && $my_config->brand != '')
                            <img class="img-responsive" src="{{url('/').defineUploadPath('brands', null).'/thumb/'.$my_config->brand}}" alt="{{$my_config->name}}" style="margin: auto;">
                        @else
                            <img class="profile-user-img img-responsive img-circle" src="{{asset('images/avatar.png')}}" class="user-image" alt="{{$my_config->name}}">
                        @endif

                        <h3 class="profile-username text-center" style="font-size: 14px;">{{$my_config->name}}</h3>
                        <p class="text-muted text-center">{{$my_config->type_id}}</p>


                        @if($my_config->brand == '')
                            <form action="{{route('configuration-brand')}}" method="post"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$my_config->id}}">
                                <div class="form-group" style="margin: 0px;">
                                    <div class="input-group">
                                        <div class="row margin-r-5">
                                            <div class="col-md-12">
                                                <input type='file' id="image" name="image" accept="image/*" class="filestyle" data-btnClass="btn-default"  data-text="Buscar"/>
                                            </div>
                                        </div>
                                        <div class="input-group-btn">
                                            <button type="submit" class="btn btn-default">Enviar</button>
                                        </div>
                                    </div>
                                    <small>Avatar(JPG, JPEG, PNG e no máximo 1MB)</small>
                                </div>
                            </form>
                        @endif

                        @if($my_config && $my_config->brand != '')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="{{route('configuration-brand-destroy', [base64_encode($my_config->id)])}}" class="btn btn-xs btn-flat bg-red"><i class="fa fa-trash"></i> Excluir Logo</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>


            <div class="col-md-9">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#settings" data-toggle="tab">Meus dados</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="settings">
                            <form action="{{route('configuration-update')}}" method="post" class="panels" id="formsubmit">
                                <input type="hidden" name="id" value="{{$my_config->id}}">
                                @include('admin.configuration.partials.form')

                                <div class="form-group">
                                    <button type="submit" class="btn btn-danger">Salvar alterações</button>
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
