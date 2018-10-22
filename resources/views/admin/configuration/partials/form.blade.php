    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Nome da empresa<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="@if(isset($my_config)){{$my_config->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="contact">Nome do contato<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Nome do contato" value="@if(isset($my_config)){{$my_config->contact}}@else{{old('contact')}}@endif" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="url">URL[Somente se for usar o site]</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="http://www.seusite.com.br" value="@if(isset($my_config)){{$my_config->url}}@else{{old('url')}}@endif" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="url_security">URL HTTPS[Somente se for usar o site]</label>
                <input type="text" class="form-control" id="url_security" name="url_security" placeholder="https://www.seusite.com.br" value="@if(isset($my_config)){{$my_config->url_security}}@else{{old('url_security')}}@endif" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">E-mail da empresa<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail da empresa" value="@if(isset($my_config)){{$my_config->email}}@else{{old('email')}}@endif" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="phone">Telefone<span class="text-danger">*</span></label>
                <input type="text" class="form-control phone" id="phone" name="phone" placeholder="Telefone" value="@if(isset($my_config)){{$my_config->phone}}@else{{old('phone')}}@endif" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="whatsapp">WhatsApp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" onkeypress="maskCellphone('#whatsapp');" value="@if(isset($my_config)){{$my_config->whatsapp}}@else{{old('whatsapp')}}@endif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="summary">Resumo sobre a empresa[máximo 250 caracteres]</label>
                <textarea class="form-control" id="summary" name="summary" maxlength="250" placeholder="Resumo sobre a empresa" required>@if(isset($my_config)){{$my_config->summary}}@else{{old('summary')}}@endif</textarea>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-xs btn-flat" data-toggle="modal" data-target="#modal-midia"><i class="fa fa-photo"></i> Adicionar mídia</button>
            <div class="form-group">
                <label for="about">Sobre a empresa<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="about" name="about" placeholder="Sobre a empresa">@if(isset($my_config)){{$my_config->about}}@else{{old('about')}}@endif</textarea>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="zipcode">CEP<span class="text-danger">*</span></label>
                <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="@if(isset($my_config)){{$my_config->zipcode}}@else{{old('zipcode')}}@endif" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="address">Endereço<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="@if(isset($my_config)){{$my_config->address}}@else{{old('address')}}@endif" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="district">Bairro<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="@if(isset($my_config)){{$my_config->district}}@else{{old('district')}}@endif" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="number">Número<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="@if(isset($my_config)){{$my_config->number}}@else{{old('number')}}@endif" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="state">Estado<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="@if(isset($my_config)){{$my_config->state}}@else{{old('state')}}@endif" required>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="city">Cidade<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="@if(isset($my_config)){{$my_config->city}}@else{{old('city')}}@endif" required>
            </div>
        </div>
    </div>


    @if(isset($status))
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="qty">Status</label>
                <select class="form-control select2" id="status_id" name="status_id" style="width: 100%;">
                    @foreach($status as $status)
                        <option @if(isset($my_config)) @if($my_config->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endif