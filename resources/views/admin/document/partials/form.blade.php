    {{ csrf_field() }}
    <div class="row">
        @if(isset($users))
            <div class="col-md-7">
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

        <div class="col-md-5">
            <div class="form-group">
                <label for="type">Informe o tipo/carteira[Cobrança, Doc. Aprovação]<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="type" name="type" placeholder="Informe o tipo/carteira[Cobrança, Doc. Aprovação]" value="@if(isset($document)){{$document->type}}@else{{old('type')}}@endif" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="name">Nome do arquivo<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Nome da categoria" value="@if(isset($document)){{$document->name}}@else{{old('name')}}@endif" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Arquivo[JPG,JPEG,PNG,PDF,DOC,DOCX]<span class="text-danger">*</span></label>
                <input type='file' id="image" name="file" accept="image/*" class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
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
