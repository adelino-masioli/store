<form action="{{route('order-annotation-store')}}" method="post" class="panels">
    <input type="hidden" name="order_id" value="{{$order->id}}">
    <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
    <input type="hidden" name="user_name" value="{{Auth::user()->name}}">
    <input type="hidden" name="color" id="color" value="bg-green">
    {{ csrf_field() }}
    <div class="row">
        <div class="box box-warning">
            <div class="box-header"><legend style="margin-bottom: 0px;">Anotações</legend></div>

            <div class="box-body">
                <div class="form-group">
                    <label for="description">Descrição <small>[máx. 100 caracteres]</small></label>
                    <input type="text" class="form-control" id="description" name="description" placeholder="Descrição" maxlength="100">
                </div>

                <div class="form-group">
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle btn-flat btn-block" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="text-align: left;">
                            <span class="label-color">Selecione uma cor</span>
                            <span class="caret" style="float: right;position: relative;top: 8px;"></span>
                        </button>
                        <ul class="dropdown-menu flat" aria-labelledby="dropdownMenu1" style="width: 100%;">
                            <li onclick="selectColor('bg-green', 'Normal');"><a class="bg-green" href="javascript:void(0);">Normal</a></li>
                            <li onclick="selectColor('bg-yellow', 'Antenção');"><a class="bg-yellow" href="javascript:void(0);">Antenção</a></li>
                            <li onclick="selectColor('bg-red', 'Crítico');"><a class="bg-red" href="javascript:void(0);">Crítico</a></li>
                        </ul>
                    </div>
                </div>
                <button type="submit" class="btn bg-aqua btn-flat btn-block">Adicionar</button>
            </div>
        </div>
    </div>
</form>

@if($annotations)
    @foreach($annotations as $annotation)
    <div class="row">
        <div class="col-md-12">
            <div class="small-box {!! $annotation->color !!}">
                <div class="inner">
                    <p>{!! $annotation->description !!}</p>

                </div>
                <span class="small-box-footer">{{$annotation->user_name}}</span>
            </div>
        </div>
    </div>
    @endforeach
@endif

@push('scripts')

    <script>
        function selectColor(color, label) {
            $('.label-color').text('');
            $('.label-color').text(label);
            $('#color').val('');
            $('#color').val(color);
        }
    </script>
@endpush
