    {{ csrf_field() }}
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="id">Código</label>
                <input type="number" class="form-control" id="customer_id" name="customer_id" placeholder="Código" value="@if(isset($order)){{$order->customer_id}}@else{{old('customer_id')}}@endif" onblur="formSearchUser();" onclick="clearClientForm();">
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <label for="name">Nome do cliente<span class="text-danger">*</span></label>
                <div class="input-group">
                    <input type="text" class="form-control" id="user_name" name="name" placeholder="Nome do cliente" value="@if(isset($order)){{$order->name}}@else{{old('name')}}@endif" required autofocus>
                    <div class="input-group-btn">
                        <button type="button" class="btn bg-aqua" onclick="formSearchUser();" onclick="clearClientForm();"><i class="fa fa-search"></i></button>
                        <button type="button" class="btn bg-red"  onclick="clearClientForm();"><i class="fa fa-close"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="form-group">
                <label for="email">E-mail do cliente</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="E-mail do cliente" value="@if(isset($order)){{$order->email}}@else{{old('email')}}@endif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="zipcode">CEP</label>
                <input type="text" class="form-control zipcode" id="zipcode" name="zipcode" placeholder="CEP" value="@if(isset($order)){{$order->zipcode}}@else{{old('zipcode')}}@endif">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="address">Endereço</label>
                <input type="text" class="form-control" id="address" name="address" placeholder="Endereço" value="@if(isset($order)){{$order->address}}@else{{old('address')}}@endif">
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <label for="district">Bairro</label>
                <input type="text" class="form-control" id="district" name="district" placeholder="Bairro" value="@if(isset($order)){{$order->district}}@else{{old('district')}}@endif">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <label for="number">Número</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Número" value="@if(isset($order)){{$order->number}}@else{{old('number')}}@endif">
            </div>
        </div>
        <div class="col-md-2">
            <div class="form-group">
                <label for="state">Estado</label>
                <input type="text" class="form-control" id="state" name="state" placeholder="Estado" maxlength="2" value="@if(isset($order)){{$order->state}}@else{{old('state')}}@endif">
            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="city">Cidade</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Cidade" value="@if(isset($order)){{$order->city}}@else{{old('city')}}@endif">
            </div>
        </div>
    </div>



@if(isset($order))
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição[aqui você pode colocar observações sobre o pedido]</label>
                <textarea class="form-control editor" id="description" name="description" placeholder="Descrição">@if(isset($order)){{$order->description}}@else{{old('description')}}@endif</textarea>
            </div>
        </div>
    </div>

    <div class="row">
        @if(isset($status))
            <div class="col-md-4">
                <div class="form-group">
                    <label for="status_id">Status</label>
                    <select class="form-control select2" id="status_id" name="status_id" style="width: 100%;">
                        @foreach($status as $status)
                            <option @if(isset($order)) @if($order->status_id == $status->id) selected @endif @endif value="{{$status->id}}">{{$status->status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        @endif
    </div>
@endif


    @push('scripts')
        <script>
            function formSearchUser(){
                var vUrlUser = '{{route('user-search')}}';
                var vDataUser = {
                    _token:$('input[name=_token]').val(),
                    id:$('#customer_id').val(),
                    name:$('#user_name').val()
                };

                if($('#customer_id').val() > 0 || $('#user_name').val().length > 0) {
                    $.post(
                        vUrlUser,
                        vDataUser,
                        function (response) {
                            if (response === 'false') {
                                toast('Importante', 'Nenhum cadastro encontrado', 'top-right', '#ff0000')
                            } else {
                                $('#customer_id').val(response.id);
                                $('#user_name').val(response.name);
                                $('#email').val(response.email);
                                $('#zipcode').val(response.complement.zipcode);
                                $('#address').val(response.complement.address);
                                $('#district').val(response.complement.district);
                                $('#number').val(response.complement.number);
                                $('#state').val(response.complement.state);
                                $('#city').val(response.complement.city);
                            }
                        }
                    );
                }
            }
            function clearClientForm(){
                $('#customer_id').val('');
                $('#user_name').val('');
                $('#email').val('');
                $('#zipcode').val('');
                $('#address').val('');
                $('#district').val('');
                $('#number').val('');
                $('#state').val('');
                $('#city').val('');
            }
        </script>
    @endpush