    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Nome da empresa<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="@if(isset($configuration)){{$configuration->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="contact">Nome do contato<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Nome do contato" value="@if(isset($configuration)){{$configuration->contact}}@else{{old('contact')}}@endif" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">E-mail da empresa<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail da empresa" value="@if(isset($configuration)){{$configuration->email}}@else{{old('email')}}@endif" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="phone">Telefone<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone" value="@if(isset($configuration)){{$configuration->phone}}@else{{old('phone')}}@endif" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="whatsapp">WhatsApp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" value="@if(isset($configuration)){{$configuration->whatsapp}}@else{{old('whatsapp')}}@endif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="about">Sobre a empresa<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="about" name="about" placeholder="Sobre a empresa" required>@if(isset($configuration)){{$configuration->about}}@else{{old('about')}}@endif</textarea>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="zipcode">CEP<span class="text-danger">*</span></label>
                <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="@if(isset($configuration)){{$configuration->zipcode}}@else{{old('zipcode')}}@endif" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="address">Endereço<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="@if(isset($configuration)){{$configuration->address}}@else{{old('address')}}@endif" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="district">Bairro<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="@if(isset($configuration)){{$configuration->district}}@else{{old('district')}}@endif" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="number">Número<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="@if(isset($configuration)){{$configuration->number}}@else{{old('number')}}@endif" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="state">Estado<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="@if(isset($configuration)){{$configuration->state}}@else{{old('state')}}@endif" required>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="city">Cidade<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="@if(isset($configuration)){{$configuration->city}}@else{{old('city')}}@endif" required>
            </div>
        </div>
    </div>


    @if(isset($status))
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="qty">Status</label>
                <select class="form-control select2" id="status_id" name="status_id">
                    @foreach($status as $status)
                        <option @if(isset($configuration)) @if($configuration->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @endif