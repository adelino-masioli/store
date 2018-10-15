<form action="{{route('frontend-calculate-dispatch-checkout')}}" method="post" id="form-consult-transport">
    {{ csrf_field() }}
    <div class="row">
        <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <input type="text" class="form-control form-control-sm" placeholder="30140" name="zipcode" id="zipcode_search" aria-label="30140" onKeyDown="onlyNumber('#zipcode_search');" maxlength="5" autofocus >
        </div>
        <div class="col col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control form-control-sm" placeholder="060" name="zipcode2" id="zipcode_search2" aria-label="060" onKeyDown="onlyNumber('#zipcode_search2');" aria-describedby="btnconsult" maxlength="3">
                <div class="input-group-append">
                    <button class="btn btn-primary btn-sm btn-flat" type="submit" id="btnconsult"><i class="fa fa-search"></i> Consultar</button>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="result-consult-transport">
    @component('frontend.blue_theme.components.transport_text') @endcomponent {{--component transport text--}}
</div>

@push('scripts')
    <script>
        $(function(){
            function calculateTransport(e) {
                $('#btnconsult').attr('disabled', true);
                $('#preloader').fadeIn();
                $('#status').fadeIn();
                $('.show-result-transport-session').hide();
                $('.show-result-transport').hide();
                $('.error-result').hide();
                $('.error-result-zipcode').hide();
                $('.error-result-nozipcode').hide();

                $.ajax({
                    url: $('#form-consult-transport').attr('action'),
                    dataType: 'json',
                    type: 'post',
                    data: $('#form-consult-transport').serialize(),
                    success: function (response) {
                        if (response.status == 10) {
                            $('.error-result-zipcode').fadeIn();
                            $('.show-result-transport').hide();
                            hidePreload();
                        } else {
                            if (response.status == false) {
                                $('.error-result').fadeIn();
                                $('.show-result-transport').hide();
                                hidePreload();
                            } else {
                                if (response.status == 12) {
                                    $('.error-result-nozipcode').fadeIn();
                                    $('.show-result-transport').hide();
                                    hidePreload();
                                }else{
                                    window.location.reload();
                                }
                            }
                        }
                        $('#btnconsult').attr('disabled', false);
                    },
                    error: function (jqXhr, textStatus, errorThrown) {
                        if (jqXhr.status == 10) {
                            $('.error-result-zipcode').fadeIn();
                        }
                        $('.error-result').fadeIn();
                        $('.show-result-transport').hide();
                        $('#preloader').fadeOut();
                        $('#status').fadeOut();

                        $('#btnconsult').attr('disabled', false);
                    }
                });
                e.preventDefault();
            }
            $('#form-consult-transport').submit( calculateTransport );
        });


        function removeTransport() {
            if(!$('#balcony').is(":checked")){
                $('#preloader').fadeIn();
                $('#status').fadeIn();
                $('.show-result-transport-session').hide();
                $('.show-result-transport').hide();
                $('.error-result').hide();

                $.ajax({
                    url: $('#form-remove-transport').attr('action'),
                    dataType: 'json',
                    type: 'post',
                    data: $('#form-remove-transport').serialize(),
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        }

        function hidePreload(){
            $('#preloader').fadeOut();
            $('#status').fadeOut();
        }
    </script>
@endpush