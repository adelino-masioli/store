    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="name">Título da mídia(Servirá como a tag ALT)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Título do banne" value="@if(isset($midia)){{$midia->name}}@else{{old('name')}}@endif" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Arquivo da mídia[JPG,JPEG,PNG]<span class="text-danger">*</span></label>
                @if(isset($midia) && $midia->file != '')
                    <p style="position: relative;top:5px;"><a href="{{route('midia-destroy-file', base64_encode($midia->id))}}"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i> Deseja excluir este mídia?</a></p>
                @else
                    <input type='file' id="image" name="file"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição para otimização da mídia<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required>@if(isset($midia)){{$midia->description}}@else{{old('description')}}@endif</textarea>
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
                            <option @if(isset($midia)) @if($midia->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
