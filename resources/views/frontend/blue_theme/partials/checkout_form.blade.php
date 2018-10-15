<legend><i class="fa fa-user"></i> Dados pessoais</legend>
<input type="hidden" class="form-control" name="id" value="{{Auth::user() ?  Auth::user()->id : ''}}">
<div class="form-group">
    <label for="name">Nome completo</label>
    <input type="text" class="form-control form-control-sm" name="name"  required autofocus value="{{Auth::user() ?  Auth::user()->name : ''}}" readonly>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="phone">Telefone</label>
            <input type="text" class="form-control form-control-sm" name="phone"  required value="{{Auth::user()->complement ?  Auth::user()->complement->phone : ''}}" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <div class="form-group">
            <label for="whatsapp">WhatsApp</label>
            <input type="text" class="form-control form-control-sm" name="cellphone"  value="{{Auth::user()->complement ?  Auth::user()->complement->cellphone : ''}}" readonly>
        </div>
    </div>
</div>
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control form-control-sm" name="email"  required value="{{Auth::user() ?  Auth::user()->email : ''}}" readonly>
</div>

<div class="row">
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="zipcode">CEP </label>
        <input type="text" class="form-control form-control-sm" name="zipcode"  required value="{{Auth::user()->complement ?  Auth::user()->complement->zipcode : ''}}" readonly>
    </div>
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="street">Rua</label>
        <input type="text" class="form-control form-control-sm" name="address"  value="{{Auth::user()->complement ?  Auth::user()->complement->address : ''}}" readonly>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="number">Número</label>
        <input type="text" class="form-control form-control-sm" name="number" value="{{Auth::user()->complement ?  Auth::user()->complement->number : ''}}" readonly>
    </div>
    <div class="form-group col-xs-12 col-sm-6 col-md-6 col-lg-6">
        <label for="district">Bairro</label>
        <input type="text" class="form-control form-control-sm" name="district" value="{{Auth::user()->complement ?  Auth::user()->complement->district : ''}}" readonly>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-lg-9 col-lg-9 col-lg-9">
        <label for="city">Cidade</label>
        <input type="text" class="form-control form-control-sm" name="city"  value="{{Auth::user()->complement ?  Auth::user()->complement->city : ''}}" readonly>
    </div>
    <div class="form-group col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <label for="state">Estado</label>
        <input type="text" class="form-control form-control-sm" name="state" value="{{Auth::user()->complement ?  Auth::user()->complement->state : ''}}" readonly>
    </div>
</div>