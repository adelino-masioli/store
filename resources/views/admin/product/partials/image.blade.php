<form action="{{route('product-image-store')}}" method="post" class="panels" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="product_id" value="{{$product->id}}">
    <div class="row">
        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Descrição da imagem<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Descrição da imagem" value="" required="required">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Imagem<span class="text-danger">*</span></label>
                <input type='file' id="image" name="image" accept="image/*" class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="is_cover">Imagem destacada?</label>

                <div class="input-group">
                    <select class="form-control select2" style="width: 100%;" name="is_cover">
                        <option value="0">Não</option>
                        <option value="1">Sim</option>
                    </select>
                    <div class="input-group-btn">
                       <button type="submit" class="btn btn-default">Enviar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="row">
    <div class="col-md-12">
        @if($product_images->count() > 0)
            <table class="table table-bordered table-condensed table-hover table-striped table-responsive">
                <thead>
                    <tr>
                        <th class="col-md-7 text-center">DESCRIÇÃO DA IMAGEM</th>
                        <th class="col-md-2 text-center">IMAGEM</th>
                        <th class="col-md-2 text-center">IMAGEM PRINCIPAL?</th>
                        <th class="col-md-1 text-center">AÇÃO</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($product_images as $product_image)
                    <tr>
                        <td class="col-md-7">{{$product_image->name}}</td>
                        <td class="col-md-2 text-center">
                            @if(File::exists( public_path().'/catalog/'.config('app.template').'/thumb/'.$product_image->image))
                                <img width="40" src="{{url('/').'/catalog/'.config('app.template').'/thumb/'.$product_image->image}}" alt="{{$product_image->name}}">
                            @else
                                <span>Sem imagem</span>
                            @endif
                        </td>
                        <td class="col-md-2 text-center">{{$product_image->name == 0 ? 'NÃO' : 'SIM'}}</td>
                        <td class="col-md-1 text-center"><a href="{{route('product-image-destroy', [base64_encode($product_image->id)])}}" class="btn btn-xs bg-red"><i class="fa fa-trash"></i></a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center">Nenhuma imagem cadastrada!</p>
        @endif
    </div>
</div>