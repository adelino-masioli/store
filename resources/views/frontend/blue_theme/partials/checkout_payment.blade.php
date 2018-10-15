<legend><i class="fa fa-dollar"></i> Pagamento</legend>

<div class="custom-control custom-radio select-opt" onclick="unselectDeposit('#bankslip');">
    <input type="radio" id="bankslip" name="payment" value="bankslip" class="custom-control-input" checked>
    <label class="custom-control-label" for="bankslip">Boleto Bancário</label>
</div>

<div class="custom-control custom-radio select-opt" onclick="selectDeposit();">
    <input type="radio" id="deposit" name="payment" value="deposit" class="custom-control-input">
    <label class="custom-control-label" for="deposit">Depósito ou Transferência</label>
</div>
<p id="deposit-information" style="display: none;font-size:12px;margin-bottom: 20px;">
    <span style="display: block;" >Banco do Brasil</span>
    <span style="display: block;" >AG: 78975</span>
    <span style="display: block;" >CC: 30155-00</span>
    <span style="display: block;" >CNPJ: 123456789-0001</span>
    <span style="display: block;" >Empresa LTDA</span>
</p>

<div class="custom-control custom-radio select-opt" onclick="unselectDeposit('#pagseguro');">
    <input type="radio" id="pagseguro" name="payment" value="pagseguro" class="custom-control-input">
    <label class="custom-control-label" for="pagseguro">PagSeguro</label>
</div>


@push('scripts')
    <script>
        function selectDeposit() {
            if(!$('#deposit').is(":checked")){
                $('#deposit-information').fadeIn();
            }
        }

        function unselectDeposit(id) {
            if(!$(id).is(":checked")){
                $('#deposit-information').fadeOut();
            }
        }
    </script>
@endpush