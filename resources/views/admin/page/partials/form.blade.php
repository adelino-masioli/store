    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="name">Título da página [Máx.: 20 caracteres]<span class="text-danger">*</span></label>
                <input type="text" class="form-control" maxlength="20" id="title" name="title" placeholder="Título da página" value="@if(isset($page)){{$page->title}}@else{{old('title')}}@endif" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Banner da página[JPG,JPEG,PNG - Tamanho: 1920px X 200px]</label>
                @if(isset($page) && $page->banner != '')
                    <p style="position: relative;top:5px;"><a href="{{route('page-destroy-file', base64_encode($page->id))}}"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i> Deseja excluir este banner da página?</a></p>
                @else
                    <input type='file' id="image" name="banner"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
                @endif
            </div>
        </div>
    </div>

    @if($page->type == 'contact')
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="googlemaps">Cole aqui o EMBED do Google Maps [<a href="https://www.google.com.br/maps" target="_blank" class="text-info"><i class="fa fa-map-marker"></i> Abrir Google Maps</a>]</label>
                <textarea class="form-control" id="googlemaps"  name="googlemaps" placeholder="Cole aqui o EMBED do Google Maps" required>@if(isset($page)){{$page->googlemaps}}@else{{old('googlemaps')}}@endif</textarea>
            </div>
        </div>
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="summary">Resumo do conteúdo da página[máximo 300 caracteres]</label>
                <textarea class="form-control" id="summary" maxlength="300" name="summary" placeholder="Resumo do conteúdo da página" required>@if(isset($page)){{$page->summary}}@else{{old('summary')}}@endif</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-xs btn-flat" data-toggle="modal" data-target="#modal-midia"><i class="fa fa-photo"></i> Adicionar mídia</button>
            <div class="form-group">
                <label for="text'">Conteúdo da página</label>
                <textarea class="form-control editor" id="text'" name="text" placeholder="Conteúdo da página" required>@if(isset($page)){{$page->text}}@else{{old('text')}}@endif</textarea>
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
                            <option @if(isset($page)) @if($page->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
        <div class="d-none hidden col-md-4">
            <div class="form-group">
                <label for="status_id">Mostrar formulário de captura na página?</label>
                <select class="form-control select2" id="show_form" name="show_form">
                    <option @if(isset($page)) @if($page->show_form == 0) selected @endif @endif value="0">NÃO</option>
                    <option @if(isset($page)) @if($page->show_form == 1) selected @endif @endif value="0">SIM</option>
                </select>
            </div>
        </div>
    </div>
