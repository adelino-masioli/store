    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Nome do produto<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do produto" value="@if(isset($category)){{$category->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required>@if(isset($category)){{$category->description}}@else{{old('description')}}@endif</textarea>
            </div>
        </div>
    </div>
    

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="qty">Status</label>
                <select name="status" class="form-control select2" id="status" name="status">
                    <option @if(isset($category)) @if($category->status == 1) selected @endif @endif value="1">Ativo</option>
                    <option @if(isset($category)) @if($category->status == 2) selected @endif @endif value="2">Inativo</option>
                </select>
            </div>
        </div>
    </div>