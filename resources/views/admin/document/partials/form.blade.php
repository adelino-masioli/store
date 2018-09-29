    {{ csrf_field() }}
    <div class="row">
        @if(isset($users))
            <div class="col-md-8">
                <div class="form-group">
                    <label for="status_id">Selecione o destinatário<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="user_id" name="user_id" required autofocus>
                        @foreach($users as $user)
                            <option @if(isset($document)) @if($document->status_id == $user->id) selected @endif @endif value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif

        @if(isset($doc_types))
            <div class="col-md-4">
                <div class="form-group">
                    <label for="type_id">Tipo do documento<span class="text-danger">*</span></label>
                    <select class="form-control select2" id="type_id" name="type_id" required>
                        @foreach($doc_types as $doc_type)
                            <option @if(isset($document)) @if($document->type_id == $doc_type->id) selected @endif @endif value="{{$doc_type->id}}">{{$doc_type->type}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="name">Nome do arquivo<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome do arquivo" value="@if(isset($document)){{$document->name}}@else{{old('name')}}@endif" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Arquivo[JPG,JPEG,PNG,PDF,DOC,DOCX]<span class="text-danger">*</span></label>
                @if(isset($document) && $document->file != '')
                    <p style="position: relative;top:5px;"><a href="{{route('document-destroy-file', base64_encode($document->id))}}"  title="Excluir" class="btn bg-red btn-xs"><i class="fa fa-trash"></i> Deseja excluir este documento?</a></p>
                @else
                    <input type='file' id="image" name="file"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição<span class="text-danger">*</span></label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição" required>@if(isset($document)){{$document->description}}@else{{old('description')}}@endif</textarea>
            </div>
        </div>
    </div>


    <div class="row">
        @if(isset($document))
            @if(isset($status))
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="status_id">Status</label>
                        <select class="form-control select2" id="status_id" name="status_id">
                            @foreach($status as $status)
                                <option @if(isset($document)) @if($document->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            @endif
        @endif


        @if(isset($configurations) && $configurations != '')
            <div class="col-md-4">
                <div class="form-group">
                    <label for="configuration_id">Empresa</label>
                    <select class="form-control select2" id="configuration_id" name="configuration_id">
                        @foreach($configurations as $configuration)
                            <option @if(isset($document)) @if($document->configuration_id == $configuration->id) selected @endif @endif value="{{$configuration->id}}">{{$configuration->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
