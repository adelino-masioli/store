    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="name">Título de destaque do banner<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Título do banner" value="@if(isset($banner)){{$banner->name}}@else{{old('name')}}@endif" required autofocus>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="form-group">
                <label for="link">URL do link[deixe em branco para não aparecer o link]</label>
                <input type="text" class="form-control" id="link" name="link" placeholder="www.linkdapagina.com.br" value="@if(isset($banner)){{$banner->link}}@else{{old('link')}}@endif">
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="name">Banner[Tamanho: 2000px de largura]<span class="text-danger">*</span></label>
                @if(isset($banner) && $banner->file != '')
                    <p style="position: relative;top:5px;"><a href="{{route('banner-destroy-file', base64_encode($banner->id))}}"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i> Deseja excluir este banner?</a></p>
                @else
                    <input type='file' id="image" name="file"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar"/>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição resumida para otimização do banner</label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição">@if(isset($banner)){{$banner->description}}@else{{old('description')}}@endif</textarea>
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
                            <option @if(isset($banner)) @if($banner->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
