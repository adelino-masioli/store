<form action="{{route('product-update')}}" method="post" class="panels">
    <div class="row">
        <div class="col-md-12">
            @include('sprintem.messages.messages_register')
        </div>
    </div>

    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$product->id}}">
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="sku">SKU<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="{{$product->sku}}" required="required">
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="name">Nome do produto<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="{{$product->name}}" required="required">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required="required">{{$product->description}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_title">Meta Título(SEO)<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="meta_title" name="meta_title" placeholder="Meta Título(SEO)" required="required">{{$product->meta_title}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_description">Meta Descrição(SEO)<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="meta_description" name="meta_description" placeholder="Meta Descrição(SEO)" required="required">{{$product->meta_description}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_keyword">Palavras-chave(SEO)<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="meta_keyword" name="meta_keyword" placeholder="Palavras-chave(SEO)" required="required">{{$product->meta_keyword}}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="price">Preço<span class="text-danger">*</span></label>
                <input type="text" class="form-control money" id="price" name="price" placeholder="Preço" value="{{$product->price}}" required="required">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="qty">Quantidade<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantidade" value="{{$product->qty}}" required="required">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="qty">Status</label>
                <select name="status" class="form-control" id="status" name="status">
                    <option @if($product->qty == 1) selected @endif value="1">Ativo</option>
                    <option @if($product->qty == 2) selected @endif value="2">Inativo</option>
                </select>
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-success btn-lg">Salvar</button>
</form>