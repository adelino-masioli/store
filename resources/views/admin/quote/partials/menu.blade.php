@if(isset($payment) || isset($cofim))
    <a href="javascript:void(0)" class="btn btn-sm bg-gray btn-flat" disabled><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</a>
    <a href="{{route('quote-edit', [$quote->id])}}" class="btn btn-sm bg-yellow btn-flat"><i class="fa fa-arrow-left" aria-hidden="true"></i> Voltar</a>
@else
    <a href="javascript:void(0)" class="btn btn-sm bg-green btn-flat" onclick="formSubmit('#formsubmit');"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</a>

    @if(isset($quteitens) && $quteitens->count() > 0)
        <a href="{{route('quote-next-payment', [$quote->id])}}" class="btn btn-sm bg-yellow btn-flat">Avançar <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    @else
        <a href="javascript:void(0)" class="btn btn-sm bg-gray btn-flat" disabled>Avançar <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
    @endif
@endif



@if(isset($payment))
    <a href="{{route('quote-next-payment-confirm', [$quote->id])}}" class="btn btn-sm bg-green btn-flat">Confirmar Pagamento e finalizar <i class="fa fa-dollar" aria-hidden="true"></i></a>
@else
    <a href="javascript:void(0)" class="btn btn-sm bg-gray btn-flat" disabled>Pagamento <i class="fa fa-dollar" aria-hidden="true"></i></a>
@endif