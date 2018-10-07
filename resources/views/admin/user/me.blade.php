@extends('admin.layouts.app')

@push('styles')
    <style>
        .bootstrap-filestyle{
            width: 100%!important;
        }
        .bootstrap-filestyle .btn{
            width: 100%!important;
        }
    </style>
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
                        @if(defineUploadPath('avatar', null).'/'.$user->avatar && $user->avatar != '')
                            <img class="profile-user-img img-responsive img-circle" src="{{url('/').defineUploadPath('avatar', null).'/'.$user->avatar}}" alt="{{$user->name}}">
                        @else
                            <img class="profile-user-img img-responsive img-circle" src="{{asset('assets/images/avatar.png')}}" class="user-image" alt="{{$user->name}}">
                        @endif

                        <h3 class="profile-username text-center">{{$user->name}}</h3>
                        <p class="text-muted text-center">{{$user->type->type}}</p>


                        @if($user->avatar == '')
                            <form action="{{route('user-avatar')}}" method="post"  enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="user_id" value="{{$user->id}}">
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

                        @if($user && $user->avatar != '')
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <a href="{{route('user-avatar-destroy', [base64_encode($user->id)])}}" class="btn btn-xs btn-flat bg-red"><i class="fa fa-trash"></i> Excluir Avatar</a>
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
                            <form class="form-horizontal" action="{{route('user-update')}}" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{$user->id}}">
                                <div class="form-group">
                                    <label for="name" class="col-sm-2 control-label">Nome do usuário<span class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"  placeholder="Nome do usuário" value="@if(isset($user)){{$user->name}}@else{{old('name')}}@endif" required autofocus>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="col-sm-2 control-label">E-mail<span class="text-danger">*</span></label>

                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="@if(isset($user)){{$user->email}}@else{{old('email')}}@endif" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="col-sm-2 control-label">Senha</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation" class="col-sm-2 control-label">Confirmar senha</label>

                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="zipcode" class="col-sm-2 control-label">CEP</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="@if(isset($user_complemento)){{$user_complemento->zipcode}}@else{{old('zipcode')}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address" class="col-sm-2 control-label">Endereço</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="@if(isset($user_complemento)){{$user_complemento->address}}@else{{old('address')}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="district" class="col-sm-2 control-label">Bairro</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="@if(isset($user_complemento)){{$user_complemento->district}}@else{{old('district')}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="number" class="col-sm-2 control-label">Número</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="@if(isset($user_complemento)){{$user_complemento->number}}@else{{old('number')}}@endif" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="state" class="col-sm-2 control-label">Estado</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="@if(isset($user_complemento)){{$user_complemento->state}}@else{{old('state')}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="city" class="col-sm-2 control-label">Cidade</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="@if(isset($user_complemento)){{$user_complemento->city}}@else{{old('city')}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone" class="col-sm-2 control-label">Telefone</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone" value="@if(isset($user_complemento)){{$user_complemento->phone}}@else{{old('phone')}}@endif">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="cellphone" class="col-sm-2 control-label">Celular</label>

                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="cellphone" name="cellphone" placeholder="Celular" value="@if(isset($user_complemento)){{$user_complemento->cellphone}}@else{{old('cellphone')}}@endif">
                                    </div>
                                </div>





                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Salvar alterações</button>
                                    </div>
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


@endsection
@push('scripts')
    <script>
        $(document).ready(function() {
            maskZipCode();
        });
    </script>
@endpush
