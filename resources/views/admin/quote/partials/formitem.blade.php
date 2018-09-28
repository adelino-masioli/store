<input type="hidden" name="quote_id" id="quote_id" value="{{$quote->id}}">
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="id">Código<span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="product_id" name="product_id" placeholder="Código" required onblur="formSearch();" onclick="clearForm();">
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group">
            <label for="product_name">Nome do produto<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_name" name="name" placeholder="Nome do produto" required required onblur="formSearch();" onclick="clearForm();">
        </div>
    </div>

    <div class="col-md-1">
        <div class="form-group">
            <label for="price">Preço<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_price" name="price" placeholder="Preço" required disabled>
        </div>
    </div>


    <div class="col-md-3">
        <div class="form-group">
            <label for="qty">Quantidade<span class="text-danger">*</span></label>

            <div class="input-group">
                <input type="number" class="form-control" id="product_qty" name="qty" placeholder="Quantidade" required>
                <div class="input-group-btn">
                    <button type="button" class="btn btn-default btn-add-quote" onclick="formAddItem();" disabled>Adicionar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row text-center" style="position: relative;">
    <img width="100" src="{{asset('images/preload.gif')}}" alt="Preloader" class="imgpreload" style="display: none;position: absolute;">
    <div class="col-md-12 show-content-table">
        @include('admin.quote.partials.tableitens')
    </div>
</div>



@push('scripts')
    <script>
        function formSearch(){
            var vUrlItem = '{{route('quote-item-search')}}';
            var vDataItem = {
                _token:$('input[name=_token]').val(),
                product_id:$('#product_id').val(),
                product_name:$('#product_name').val()
            };

            if($('#product_id').val() > 0 || $('#product_name').val().length > 0) {
                $.post(
                    vUrlItem,
                    vDataItem,
                    function (response) {
                        if (response === 'false') {
                            toast('Importante', 'Nenhum produto encontrado', 'top-right', '#ff0000')

                            $('#product_id').val('');
                            $('#product_name').val('');
                            $('#product_price').val('');

                            $('.btn-add-quote').attr('disabled', 'disabled')
                        } else {
                            $('#product_id').val(response.id);
                            $('#product_name').val(response.name);
                            $('#product_price').val(response.price);
                            $('.btn-add-quote').attr('disabled', false)
                        }
                    }
                );
            }
        }


        function formAddItem(){
            var vUrlItem = '{{route('quote-item-store')}}';
            var vDataItem = {
                _token:$('input[name=_token]').val(),
                product_id:$('#product_id').val(),
                product_name:$('#product_name').val(),
                quote_id:$('#quote_id').val(),
                product_price:$('#product_price').val(),
                product_qty:$('#product_qty').val(),
            };

            $.post(
                vUrlItem,
                vDataItem,
                function (response) {
                    if (response === 'true') {
                        toast('Importante', 'Produto adicionado com sucesso!', 'top-right', '#2dff2e')
                        getTableItens($('#quote_id').val());
                        clearForm();
                    } else {
                        toast('Importante', 'Erro ao adicionar o produto!', 'top-right', '#ff0000')
                    }
                }
            );
        }


        function addDiscount(){
            var vUrldiscount = '{{route('quote-discount-store')}}';
            var vDatadiscount = {
                _token:$('input[name=_token]').val(),
                discount:$('#discount').val(),
                quote_id:$('#quote_id').val(),
            };

            $.post(
                vUrldiscount,
                vDatadiscount,
                function (response) {
                    if (response === 'true') {
                        toast('Importante', 'Desconto adicionado com sucesso!', 'top-right', '#2dff2e')
                        getTableItens($('#quote_id').val());
                    } else {
                        toast('Importante', 'Erro ao adicionar o desconto!', 'top-right', '#ff0000')
                    }
                }
            );
        }

        function destroyItem(id){
            var vUrldiscount = '{{route('quote-item-destroy')}}';
            var vDatadiscount = {
                _token:$('input[name=_token]').val(),
                item:id,
                quote_id:$('#quote_id').val(),
            };

            $.post(
                vUrldiscount,
                vDatadiscount,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante', 'Item excluído com sucesso!', 'top-right', '#2dff2e')
                        getTableItens($('#quote_id').val());
                    } else {
                        toast('Importante', 'Erro ao excluir o ítem!', 'top-right', '#ff0000')
                    }
                }
            );
        }

        function getTableItens(id){
            $('.imgpreload').fadeIn();
            var vUrlGetItem = '{{url('admin/quote-item/get')}}';
            //$( ".show-content-table" ).css('opacity', 0);
            $.get(vUrlGetItem+'/'+id, function( data ) {
                $('.imgpreload').fadeOut();
                setTimeout(function () {
                    //$( ".show-content-table" ).css('opacity', 1);
                    $( ".show-content-table" ).fadeIn(500);
                    $( ".show-content-table" ).html( data );
                },600)
            });
        }

        function enableBtn(btn, txtinput) {
            if($(txtinput).val().length !=0) {
                $(btn).attr('disabled', false)
            }else{
                $(btn).attr('disabled', 'disabled')
            }
        }

        function  clearForm() {
            $('#product_id').val('');
            $('#product_name').val('');
            $('#product_price').val('');
            $('#product_qty').val('');
        }
    </script>
@endpush