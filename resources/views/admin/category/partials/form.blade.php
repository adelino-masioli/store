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
            <div class="col-md-4">
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


        @if(isset($configurations) && $configurations != '')
            <div class="col-md-4">
                <div class="form-group">
                    <label for="configuration_id">Empresa</label>
                    <select class="form-control select2" id="configuration_id" name="configuration_id">
                        @foreach($configurations as $configuration)
                            <option @if(isset($category)) @if($category->configuration_id == $configuration->id) selected @endif @endif value="{{$configuration->id}}">{{$configuration->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
