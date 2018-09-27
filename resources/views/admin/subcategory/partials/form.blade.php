    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Nome da subcategoria<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome da categoria" value="@if(isset($subcategory)){{$subcategory->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required>@if(isset($subcategory)){{$subcategory->description}}@else{{old('description')}}@endif</textarea>
            </div>
        </div>
    </div>


    <div class="row">
        @if(isset($categories))
            <div class="col-md-4">
                <div class="form-group">
                    <label for="category_id">Status</label>
                    <select class="form-control select2" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option @if(isset($subcategory)) @if($subcategory->status_id == $category->id) selected @endif @endif value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        @if(isset($status))
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select class="form-control select2" id="status_id" name="status_id">
                        @foreach($status as $status)
                            <option @if(isset($subcategory)) @if($subcategory->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
