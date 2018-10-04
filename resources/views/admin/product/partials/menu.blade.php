<a href="{{route('products')}}" onclick="localStorage.clear();" class="btn btn-sm bg-aqua margin-r-5 btn-flat"><i class="fa fa-list"></i> Listagem de Produto</a>
<a href="javascript:void(0)" class="btn btn-sm bg-yellow btn-flat  margin-r-5" onclick="formSubmit('#formsubmit');"><i class="fa fa-check-circle"></i> Salvar Produto</a>
@if(isset($product))
    <a href="{{route('product-create')}}" onclick="localStorage.clear();" class="btn btn-sm bg-blue btn-flat"><i class="fa fa-plus"></i> Novo Produto</a>
@endif