@if($my_config->brand == '')
    <form action="{{route('configuration-brand')}}" method="post" class="panels" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id" value="{{$my_config->id}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="image">Logo(JPG, JPEG, PNG e no máximo 1MB)</label>
                    <div class="input-group">
                        <div class="row margin-r-5">
                            <div class="col-md-12">
                                <input type='file' id="image" name="image" accept="image/*" class="filestyle" data-btnClass="btn-default"  data-text="Selecionar"/>
                            </div>
                        </div>
                        <div class="input-group-btn">
                           <button type="submit" class="btn btn-default">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endif
@if($my_config && $my_config->brand != '')
    <div class="row">
        <div class="col-md-12 text-center">
            @if(defineUploadPath('brands', null).'/'.$my_config->brand)
                <img src="{{url('/').defineUploadPath('brands', null).'/thumb/'.$my_config->brand}}" alt="{{$my_config->name}}">
            @endif
        </div>
        <div class="col-md-12 text-center">
            <a href="{{route('configuration-brand-destroy', [base64_encode($my_config->id)])}}" class="btn btn-xs btn-flat bg-red"><i class="fa fa-trash"></i> Excluir</a>
        </div>
    </div>
@endif