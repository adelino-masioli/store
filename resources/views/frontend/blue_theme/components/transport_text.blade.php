@if(session()->has('transport'))
    <div class="show-result-transport-session">
        <p>Para saber o prazo de entrega/postagem e o valor do frete, digite o seu CEP nos campos acima. O prazo pode variar dependendo da sua forma de entrega/postagem.</p>
        <p>Disponibilidade: Até <span>{{session()->get('transport')['prazo']}}</span> para {{session()->get('transport')['localidade']}}, {{session()->get('transport')['uf']}}</p>
        <p>O valor do frete deste produto é: R$ <span>{{session()->get('transport')['valor']}}</span></p>
    </div>
@endif

<div class="show-result-transport" style="display: none;">
    <p>Para saber o prazo de entrega/postagem e o valor do frete, digite o seu CEP nos campos acima. O prazo pode variar dependendo da sua forma de entrega/postagem.</p>
    <p>Disponibilidade: Até <span id="transport-days"></span> para <span id="span_city"></span>,  <span id="span_state"></span></p>
    <p>O valor do frete deste produto é: R$ <span id="transport-price"></span></p>
</div>

<p class="text-danger error-result" style="display: none;">
    O CEP selecionado não é atendido pelos Correios para entrega no domicilio.
</p>

<p class="text-danger error-result-zipcode" style="display: none;">
    O CEP informado, é diferente do que já foi calculado: <strong>{{session()->get('zipcode')}}</strong>.
</p>