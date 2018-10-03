    {{ csrf_field() }}
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    <input type="hidden" name="name" value="{{Auth::user()->name}}">
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="title">Assunto<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="title" name="title" placeholder="Assunto" value="@if(isset($support)){{$support->title}}@else{{old('title')}}@endif" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Arquivo[JPG,JPEG,PNG,PDF,DOC,DOCX]</label>
                @if(isset($support) && $support->file != '')
                    <p style="position: relative;top:5px;"><a href="{{route('customer-support-destroy-file', base64_encode($support->id))}}"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i> Deseja excluir este arquivo?</a></p>
                @else
                    <input type='file' id="image" name="file"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição do chamado<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required>@if(isset($support)){{$support->description}}@else{{old('description')}}@endif</textarea>
            </div>
        </div>
    </div>