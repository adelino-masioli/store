<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <label for="id">Código<span class="text-danger">*</span></label>
            <input type="number" class="form-control" id="product_id" name="product_id" placeholder="Código" required onblur="formSearch();" onclick="clearForm();">
        </div>
    </div>

    <div class="col-md-5">
        <div class="form-group">
            <label for="product_name">Nome do produto<span class="text-danger">*</span></label>
            <input type="text" class="form-control" id="product_name" name="name" placeholder="Nome do produto" required required onblur="formSearch();" onclick="clearForm();">
        </div>
    </div>

    <div class="col-md-2">
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
                    <button type="button" class="btn btn-default btn-add-order" onclick="formAddItem();" disabled>Adicionar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
   <div class="col-md-12">
       <table class="table table-responsive table-striped table-condensed table-hover table-bordered" style="width: 100%;">
           <thead>
               <tr>
                   <th class="col-md-1 text-center">CÓDIGO</th>
                   <th class="col-md-1 text-center">AÇÃO</th>
                   <th class="col-md-7 text-center">NOME DO PRODUTO</th>
                   <th class="col-md-1 text-center">PREÇO</th>
                   <th class="col-md-1 text-center">QTDE</th>
                   <th class="col-md-1 text-center">SUBTOTAL</th>
               </tr>
           </thead>
           <tbody class="list-results-items"></tbody>

           <tfoot>
           <tr>
               <th class="col-md-1 text-center"></th>
               <th class="col-md-1 text-right"></th>
               <th class="col-md-7 text-right">DESCONTO</th>
               <th class="col-md-1 text-center"><input type="text" class="form-control input-sm money textdiscount" name="discount" id="discount" placeholder="R$" onkeyup="enableBtn('.btn-add-discount', '.textdiscount');" onclick="masMoney();"></th>
               <th class="col-md-1 text-center"><button type="button" class="btn btn-sm bg-yellow btn-block btn-flat btn-add-discount" onclick="addDiscount();" disabled><i class="fa fa-plus-circle"></i></button></th>
               <th class="col-md-1 text-right discount">@if(Session::has('discount')) {{Session::get('discount')}} @else 0,00 @endif</th>
           </tr>
           <tr>
               <th class="col-md-1 text-center"></th>
               <th class="col-md-1 text-right"></th>
               <th class="col-md-7 text-center"></th>
               <th class="col-md-1 text-center"></th>
               <th class="col-md-1 text-center">TOTAL</th>
               <th class="col-md-1 text-right total">0,00</th>
           </tr>
           </tfoot>
       </table>
   </div>
</div>

@push('scripts')
    <script>
        function formSearch(){
            var vUrlItem = '{{route('order-item-search')}}';
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

                            $('.btn-add-order').attr('disabled', 'disabled')
                        } else {
                            $('#product_id').val(response.id);
                            $('#product_name').val(response.name);
                            $('#product_price').val(response.price);
                            $('.btn-add-order').attr('disabled', false)
                        }
                    }
                );
            }
        }


        function formAddItem(){
            var vUrlItem = '{{route('quote-item-store')}}';
            var vDataItem = {
                _token:$('input[name=_token]').val(),
                id:$('#product_id').val(),
                product_name:$('#product_name').val(),
                product_price:$('#product_price').val(),
                product_qty:$('#product_qty').val(),
            };

            $.post(
                vUrlItem,
                vDataItem,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante', response.response, 'top-right', '#2dff2e')
                        getTableItens();
                        clearForm();
                    } else {
                        toast('Importante', response.response, 'top-right', '#ff0000')
                    }
                }
            );
        }


        function removeCartItem(id){
            var urlRemove = '{{route('quote-item-remove', null)}}';
            var vDatadiscount = {
                _token:$('input[name=_token]').val(),
                id:id
            };
            $.post(
                urlRemove,
                vDatadiscount,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante',  response.response, 'top-right', '#2dff2e')
                        getTableItens();
                        if(response.discount){
                            $('.discount').html(response.discount);
                        }
                    } else {
                        toast('Importante',  response.response, 'top-right', '#ff0000')
                    }
                }
            );
        }

        function addDiscount(){
            var urlRemove = '{{route('quote-item-discount')}}';
            var vDatadiscount = {
                _token:$('input[name=_token]').val(),
                discount:$('#discount').val()
            };
            $.post(
                urlRemove,
                vDatadiscount,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante',  response.response, 'top-right', '#2dff2e')
                        $('.total').html(response.total);
                        $('.discount').html(response.discount);
                    } else {
                        toast('Importante',  response.response, 'top-right', '#ff0000')
                        $('.discount').html('0,00');
                    }
                }
            );
        }

        function cancelOrder(){
            var urlRemove = '{{route('quote-item-cancel')}}';
            var vDatadiscount = {
                _token:$('input[name=_token]').val(),
            };
            $.post(
                urlRemove,
                vDatadiscount,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante',  response.response, 'top-right', '#2dff2e')
                        $('#modal-quote').modal('hide');
                        getTableItens();
                    } else {
                        toast('Importante',  response.response, 'top-right', '#ff0000')
                    }
                }
            );
        }

        function finishOrder(){
            var urlRemove = '{{route('quote-item-finish')}}';
            var vDatadiscount = {
                _token:$('input[name=_token]').val(),
                discount:$('#discount').val(),
                customer_id:$('#customer_id').val()
            };
            $.post(
                urlRemove,
                vDatadiscount,
                function (response) {
                    if (response.status === 1) {
                        toast('Importante',  response.response, 'top-right', '#2dff2e')
                        $('#modal-quote').modal('hide');
                        getTableItens();
                        getDataQuote();
                    } else {
                        toast('Importante',  response.response, 'top-right', '#ff0000')
                    }
                }
            );
        }


        function getTableItens(){
            var vUrlGetItem = '{{route('contact-quote-index')}}';
            var listItems = '';
            var listItemTotal = '';
            $.get(vUrlGetItem, function(results) {
                var json_str = results;
                //loop on json
                json_str.forEach(function(data) {
                    if(data.id != undefined) {
                        listItems += '<tr>\n' +
                            '            <td class="col-md-1 text-center">' + data.id + '</td>\n' +
                            '            <td class="col-md-1 text-center"><button onclick="removeCartItem(&apos;'+data.rowId+'&apos;);" class="btn btn-xs bg-red"><i class="fa fa-trash"></i></button></td>\n' +
                            '            <td class="col-md-7 text-left">' + data.name + '</td>\n' +
                            '            <td class="col-md-1 text-right">' + data.price + '</td>\n' +
                            '            <td class="col-md-1 text-center">' + data.qty + '</td>\n' +
                            '            <td class="col-md-1 text-right">' + data.subtotal + '</td>\n' +
                            '        </tr>'
                    }
                    listItemTotal = data.total;
                });
                $('.total').html(listItemTotal);
                $('.list-results-items').html(listItems);
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

        $('#modal-quote').on('shown.bs.modal', function () {
            getTableItens()
        })
    </script>
@endpush