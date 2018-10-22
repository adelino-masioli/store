<div class="box box-info">
    <div class="box-header with-border"><i class="fa fa-building"></i> Dados da Empresa</div>

    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_name">Nome da empresa</label>
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Nome da empresa" value="@if(isset($company)){{$company->name}}@else{{old('company_name')}}@endif">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="contact_name">Nome do contato</label>
                    <input type="text" class="form-control" id="contact_name" name="contact_name" placeholder="Nome do contato" value="@if(isset($company)){{$company->contact_name}}@else{{old('contact_name')}}@endif">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_email">E-mail</label>
                    <input type="email" class="form-control" id="company_email" name="company_email" placeholder="E-mail" value="@if(isset($company)){{$company->email}}@else{{old('company_email')}}@endif">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_site">Site</label>
                    <input type="text" class="form-control" id="company_site" name="company_site" placeholder="Site" value="@if(isset($company)){{$company->site}}@else{{old('company_site')}}@endif">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_phone">Telefone</label>
                    <input type="text" class="form-control phone" id="company_phone" name="company_phone" placeholder="Telefone" value="@if(isset($company)){{$company->phone}}@else{{old('company_phone')}}@endif" onkeypress="maskCellphone('#company_phone');">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_cellphone">Celular</label>
                    <input type="text" class="form-control" id="company_cellphone" name="company_cellphone" placeholder="Celular" value="@if(isset($company)){{$company->cellphone}}@else{{old('company_cellphone')}}@endif" onkeypress="maskCellphone('#company_cellphone');">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="zipcode">CEP</label>
                    <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="@if(isset($company)){{$company->zipcode}}@else{{old('zipcode')}}@endif">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="address">Endereço</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="@if(isset($company)){{$company->address}}@else{{old('address')}}@endif">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="district">Bairro</label>
                    <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="@if(isset($company)){{$company->district}}@else{{old('district')}}@endif">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="number">Número</label>
                    <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="@if(isset($company)){{$company->number}}@else{{old('number')}}@endif">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="state">Estado</label>
                    <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="@if(isset($company)){{$company->state}}@else{{old('state')}}@endif" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="city">Cidade</label>
                    <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="@if(isset($company)){{$company->city}}@else{{old('city')}}@endif" required>
                </div>
            </div>
        </div>
    </div>
</div>