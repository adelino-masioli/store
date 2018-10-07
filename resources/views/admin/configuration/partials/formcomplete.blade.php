    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="name">Nome da empresa<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="{{old('name')}}" required autofocus>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="contact">Nome do contato<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="contact" name="contact" placeholder="Nome do contato" value="{{old('contact')}}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="url">URL[Somente se for usar o site]</label>
                <input type="text" class="form-control" id="url" name="url" placeholder="http://www.seusite.com.br" value="{{old('url')}}" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="url_security">URL HTTPS[Somente se for usar o site]</label>
                <input type="text" class="form-control" id="url_security" name="url_security" placeholder="https://www.seusite.com.br" value="{{old('url_security')}}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <label for="email">E-mail da empresa<span class="text-danger">*</span></label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail da empresa" value="{{old('email')}}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="phone">Telefone<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone" value="{{old('phone')}}" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="whatsapp">WhatsApp</label>
                <input type="text" class="form-control" id="whatsapp" name="whatsapp" placeholder="WhatsApp" value="{{old('whatsapp')}}">
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="zipcode">CEP<span class="text-danger">*</span></label>
                <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="{{old('zipcode')}}" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="address">Endereço<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="{{old('address')}}" required>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="district">Bairro<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="{{old('district')}}" required>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="number">Número<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="{{old('number')}}" required>
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="state">Estado<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="{{old('state')}}" required>
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="city">Cidade<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="{{old('city')}}" required>
            </div>
        </div>
    </div>