<div class="consult-transport">
    <form action="{{route('frontend-calculate-dispatch')}}" method="post" id="form-consult-transport">
        {{ csrf_field() }}
        <label for="consult">Consulte o frete</label>
        <div class="row">
            <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <input type="text" class="form-control" placeholder="30140" name="zipcode" id="zipcode_search" aria-label="30140" onKeyDown="onlyNumber('#zipcode_search');" maxlength="5" autofocus >
            </div>
            <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-3">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="060" name="zipcode2" id="zipcode_search2" aria-label="060" onKeyDown="onlyNumber('#zipcode_search2');" aria-describedby="btnconsult" maxlength="3">
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="btnconsult"><i class="fa fa-search"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="weight" id="weight" value="{{$product->weight}}">
        <input type="hidden" name="height" id="height" value="{{$product->height}}">
        <input type="hidden" name="width" id="width" value="{{$product->width}}">
        <input type="hidden" name="length" id="length" value="{{$product->length}}">
        <input type="hidden" name="packing" id="packing" value="{{$product->packing}}">
    </form>

    <div class="result-consult-transport">
        @component('frontend.blue_theme.components.transport_text') @endcomponent {{--component transport text--}}
    </div>

</div>

@push('scripts')
    <script>
        $(function(){
            function calculateTransport(e) {
                $('#preloader').fadeIn();
                $('#status').fadeIn();
                $('.show-result-transport-session').hide();
                $('.show-result-transport').hide();
                $('.error-result').hide();
                $('.error-result-zipcode').hide();

                $.ajax({
                    url: $('#form-consult-transport').attr('action'),
                    dataType: 'json',
                    type: 'post',
                    data: $('#form-consult-transport').serialize(),
                    success: function (response) {
                        if (response.status == 10) {
                            $('.error-result-zipcode').fadeIn();
                            $('.show-result-transport').hide();
                        } else {
                            if (response.status == false) {
                                $('.error-result').fadeIn();
                                $('.show-result-transport').hide();
                            } else {
                                $('.show-result-transport').fadeIn();
                                $('#transport-days').html(response.prazo);
                                $('#transport-price').html(response.valor);
                                $("#span_city").html(response.localidade);
                                $("#span_state").html(response.uf);
                            }
                        }
                        $('#preloader').fadeOut();
                        $('#status').fadeOut();
                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        if (jqXhr.status == 10) {
                            $('.error-result-zipcode').fadeIn();
                        }
                        $('.error-result').fadeIn();
                        $('.show-result-transport').hide();
                        $('#preloader').fadeOut();
                        $('#status').fadeOut();
                    }
                });
                e.preventDefault();
            }
            $('#form-consult-transport').submit( calculateTransport );
        });
    </script>
@endpush