    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="name">Título de destaque do banner<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Título do banne" value="@if(isset($banner)){{$banner->name}}@else{{old('name')}}@endif" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Arquivo do banner[JPG,JPEG,PNG - Tamanho: 1920px(Larg)]<span class="text-danger">*</span></label>
                @if(isset($banner) && $banner->file != '')
                    <p style="position: relative;top:5px;"><a href="{{route('banner-destroy-file', $banner->id)}}"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i> Deseja excluir este banner?</a></p>
                @else
                    <input type='file' id="image" name="file"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição resumida para otimização do banner<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required>@if(isset($banner)){{$banner->description}}@else{{old('description')}}@endif</textarea>
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


        @if(isset($configurations) && $configurations != '')
            <div class="col-md-4">
                <div class="form-group">
                    <label for="configuration_id">Empresa</label>
                    <select class="form-control select2" id="configuration_id" name="configuration_id">
                        @foreach($configurations as $configuration)
                            <option @if(isset($banner)) @if($banner->configuration_id == $configuration->id) selected @endif @endif value="{{$configuration->id}}">{{$configuration->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
