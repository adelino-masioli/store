<legend><i class="fa fa-dollar"></i> Pagamento</legend>

<div class="custom-control custom-radio select-opt" onclick="selectPayment('#bankslip', '#bankslip-information', '.payselected');">
    <input type="radio" id="bankslip" name="payment" value="bankslip" class="custom-control-input" checked>
    <label class="custom-control-label" for="bankslip">Boleto Bancário</label>
</div>
<p id="bankslip-information" class="payselected" style="display: none;font-size:12px;margin-bottom: 20px;">
    <span style="display: block;" >Para pagamentos por Boleto Bancário, só será produzido ou enviado o produto após a autorização do banco.</span>
</p>

<div class="custom-control custom-radio select-opt" onclick="selectPayment('#payment', '#deposit-information', '.payselected');">
    <input type="radio" id="deposit" name="payment" value="deposit" class="custom-control-input">
    <label class="custom-control-label" for="deposit">Depósito ou Transferência</label>
</div>
<p id="deposit-information" class="payselected" style="display: none;font-size:12px;margin-bottom: 20px;">
    <span style="display: block;" >Banco do Brasil</span>
    <span style="display: block;" >AG: 78975</span>
    <span style="display: block;" >CC: 30155-00</span>
    <span style="display: block;" >CNPJ: 123456789-0001</span>
    <span style="display: block;" >Empresa LTDA</span>
</p>

<div class="custom-control custom-radio select-opt d-none" onclick="unselectPayment('.payselected');">
    <input type="radio" id="pagseguro" name="payment" value="pagseguro" class="custom-control-input">
    <label class="custom-control-label" for="pagseguro">PagSeguro</label>
</div>


@push('scripts')
    <script>
        function selectPayment(id, div, divhide) {
            if(!$(id).is(":checked")){
                unselectPayment(divhide);
                $(div).show();
            }
        }
        function unselectPayment(div) {
            if(!$(div).is(":checked")){
                $(div).hide();
            }
        }
    </script>
@endpush