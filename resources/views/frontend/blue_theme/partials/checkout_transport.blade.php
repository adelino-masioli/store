<legend><i class="fa fa-truck"></i> Envio</legend>

<?php $total = 0;?>
<?php $total_transport = 0;?>
@foreach(Cart::content() as $row)
    @if($row->options->transp_price != null)
        <?php $total_transport +=  moneyReverse($row->options->transp_price) * $row->qty;?>
        <?php $total += ($row->price * $row->qty) + $total_transport;?>
    @else
        <?php $total += $row->price * $row->qty;?>
    @endif
@endforeach

<form action="{{route('frontend-calculate-dispatch-checkout-remove')}}" method="post" id="form-remove-transport">
    {{ csrf_field() }}
    <div class="custom-control custom-radio select-opt" onclick="removeTransport();">
        <input type="radio" id="balcony" name="transport" value="balcony" class="custom-control-input" @if($row->options->transp_price == null) checked @endif>
        <label class="custom-control-label" for="balcony">Retirada Balcão</label>
    </div>
    <p>
    <div class="custom-control custom-radio select-opt">
        <input type="radio" id="correio" name="transport" value="correio" class="custom-control-input" data-toggle="modal" data-target="#correioModal" @if($row->options->transp_price != null) checked @endif>
        <label class="custom-control-label" for="correio" data-toggle="modal" data-target="#correioModal">Correios</label>
    </div>
    </p>
</form>

@if($row->options->transp_price != null)
    <div class="result-address" style="font-size:10px;margin-bottom: 20px;">
        <p>{{$row->options->transp_city}},  {{$row->options->transp_state}}.<br/>
            O valor do frete é: <span>R$ {{money_br($total_transport)}}</span> e o prazo
            de entrega dos <strong>Correios</strong> após o envio é de até <span>{{$row->options->transp_days}}</span></p>
    </div>
@endif



<!-- Correio Modal -->
<div class="modal fade" id="correioModal" tabindex="-1" role="dialog" aria-labelledby="correioModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Calcular envio Correios</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @component('frontend.blue_theme.components.transport_checkout') @endcomponent {{--component transport--}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm btn-flat" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary btn-sm btn-flat">Confirmar</button>
            </div>
        </div>
    </div>
</div>