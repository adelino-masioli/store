    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="sku">SKU<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="sku" name="sku" placeholder="SKU" value="@if(isset($product)){{$product->sku}}@else{{old('sku')}}@endif" required="required">
            </div>
        </div>
        <div class="col-md-10">
            <div class="form-group">
                <label for="name">Nome do produto<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="@if(isset($product)){{$product->name}}@else{{old('name')}}@endif" required="required">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required="required">@if(isset($product)){{$product->description}}@else{{old('description')}}@endif</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_title">Meta Título(SEO)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="meta_title" name="meta_title" placeholder="Meta Título(SEO)" value="@if(isset($product)){{$product->meta_title}}@else{{old('meta_title')}}@endif" required="required">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_description">Meta Descrição(SEO)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="meta_description" name="meta_description" placeholder="Meta Descrição(SEO)" value="@if(isset($product)){{$product->meta_description}}@else{{old('meta_description')}}@endif" required="required">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="meta_keyword">Palavras-chave(SEO - separadas por vírgula)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" placeholder="Palavras-chave(SEO - separadas por vírgul)" value="@if(isset($product)){{$product->meta_keyword}}@else{{old('meta_keyword')}}@endif" required="required">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="price">Preço<span class="text-danger">*</span></label>
                <input type="text" class="form-control money" id="price" name="price" placeholder="Preço" value="@if(isset($product)){{$product->price}}@else{{old('price')}}@endif" required="required">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="qty">Quantidade<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="qty" name="qty" placeholder="Quantidade" value="@if(isset($product)){{$product->qty}}@else{{old('qty')}}@endif" required="required">
            </div>
        </div>
        @if(isset($product))
            @if(isset($status))
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="status_id">Status</label>
                        <select class="form-control select2" id="status_id" name="status_id">
                            @foreach($status as $status)
                                <option @if(isset($product)) @if($product->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        @endif



        @if(isset($configurations) && $configurations != '')
            <div class="col-md-5">
                <div class="form-group">
                    <label for="configuration_id">Empresa</label>
                    <select class="form-control select2" id="configuration_id" name="configuration_id">
                        @foreach($configurations as $configuration)
                            <option @if(isset($product)) @if($product->configuration_id == $configuration->id) selected @endif @endif value="{{$configuration->id}}">{{$configuration->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>