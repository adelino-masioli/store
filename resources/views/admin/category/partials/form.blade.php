    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Nome da categoria<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome da categoria" value="@if(isset($category)){{$category->name}}@else{{old('name')}}@endif" required autofocus>
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
        @if(isset($status))
            <div class="col-md-3">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select class="form-control select2" id="status_id" name="status_id">
                        @foreach($status as $status)
                            <option @if(isset($category)) @if($category->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif


        <div class="col-md-3">
            <div class="form-group">
                <label for="display_on_menu">Mostrar no menu?</label>
                <select class="form-control select2" id="display_on_menu" name="display_on_menu">
                    <option @if(isset($category)) @if($category->display_on_menu == 0) selected @endif @endif value="0">Não</option>
                    <option @if(isset($category)) @if($category->display_on_menu == 1) selected @endif @endif value="1">Sim</option>
                </select>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="order">Ordem<span class="text-danger">*</span></label>
                <input type="number" class="form-control" id="order" name="order" placeholder="Ordem" value="@if(isset($category)){{$category->order}}@else{{old('order')}}@endif" required>
            </div>
        </div>
    </div>
