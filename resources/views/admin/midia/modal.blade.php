<div class="modal fade" id="modal-midia">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                    <h4 class="modal-title">Mídias</h4>
            </div>
            <div class="modal-body" style="min-height: 300px;width:100%;position: relative;display: flex;">
                <span class="imgpreload"><img width="120" src="{{asset('images/preload.gif')}}" alt="Preloader"></span>
                <ul class="list-results-midia text-center"></ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Fechar</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@push('scripts')
    <script>
        $('#modal-midia').on('hidden.bs.modal', function () {
            $('.list-results-midia').hide();
            $('.list-results-midia').html('');
            $('.imgpreload').show();
        })
        $('#modal-midia').on('shown.bs.modal', function () {
            var midiaslist = '';
            var vDataUser = {
                _token:$('input[name=_token]').val()
            };
            var thumbpath = "{{url('/').defineUploadPath('midias', null)}}thumb/";
            var fullpath = "{{url('/').defineUploadPath('midias', null)}}";

            $.post("{{route('midia-modal')}}", vDataUser, function( result ) {
                var json_str = result;
                //loop on json
                json_str.forEach(function(data) {
                    midiaslist += '<li onclick="addImage(\''+fullpath+data.file+'\');" class="col-xs-3 col-sm-1 col-md-1" style="background-image: url('+thumbpath+data.file+')"></li>';
                });
                $('.imgpreload').fadeOut(700);
                $('.list-results-midia').show();
                $('.list-results-midia').html(midiaslist);
            });

        })
    </script>
@endpush