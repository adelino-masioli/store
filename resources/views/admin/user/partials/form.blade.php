    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Nome do usuário<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="@if(isset($user)){{$user->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail" value="@if(isset($user)){{$user->email}}@else{{old('email')}}@endif" required>
            </div>
        </div>

        <div class="col-md-2">
            <div class="form-group">
                <label for="password">Senha<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Senha"  required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="password_confirmation">Confirmar senha<span class="text-danger">*</span></label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha" required>
            </div>
        </div>
    </div>
    <div class="row">
        @if(isset($status))
        <div class="col-md-4">
            <div class="form-group">
                <label for="status_id">Status</label>
                <select class="form-control select2" id="status_id" name="status_id">
                    @foreach($status as $status)
                        <option @if(isset($user)) @if($user->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif

        @if(isset($types))
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type_id">Perfil do Usuário</label>
                    <select class="form-control select2" id="type_id" name="type_id">
                        @foreach($types as $type)
                            <option @if(isset($user)) @if($user->type_id == $type->id) selected @endif @endif value="{{$type->id}}">{{$type->type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif


            @if(isset($configurations) && $configurations != '')
            <div class="col-md-4">
                <div class="form-group">
                    <label for="configuration_id">Empresa</label>
                    <select class="form-control select2" id="configuration_id" name="configuration_id">
                        @foreach($configurations as $configuration)
                            <option @if(isset($user)) @if($user->configuration_id == $configuration->id) selected @endif @endif value="{{$configuration->id}}">{{$configuration->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
