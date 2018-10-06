@if($customer->avatar == '')
    <form action="{{route('user-avatar')}}" method="post" class="panels" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="user_id" value="{{$customer->id}}">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="image">Avatar(JPG, JPEG, PNG e no máximo 1MB)</label>
                    <div class="input-group">
                        <div class="row margin-r-5">
                            <div class="col-md-12">
                                <input type='file' id="image" name="image" accept="image/*" class="filestyle" data-btnClass="btn-default"  data-text="Selecionar avatar"/>
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
@if($customer && $customer->avatar != '')
    <div class="row">
        <div class="col-md-12 text-center">
            @if(defineUploadPath('avatar', null).'/'.$customer->avatar)
                <img src="{{url('/').defineUploadPath('avatar', null).'/thumb/'.$customer->avatar}}" alt="{{$customer->name}}">
            @endif
        </div>
        <div class="col-md-12 text-center">
            <a href="{{route('user-avatar-destroy', [base64_encode($customer->id)])}}" class="btn btn-xs btn-flat bg-red"><i class="fa fa-trash"></i> Excluir</a>
        </div>
    </div>
@endif