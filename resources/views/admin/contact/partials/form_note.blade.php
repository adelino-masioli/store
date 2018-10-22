<form action="{{route('contact-note-store')}}" method="post"  id="formNoteSubmit">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$contact->id}}">
    <input type="hidden" name="note_id" id="note_id">
    <input type="hidden" name="getdata" id="getdata" value="true">

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <label for="note">Anotações</label>
                <textarea  class="form-control" name="note" id="txt_note" placeholder="Anotações" rows="3"></textarea>
            </div>
        </div>
        <div class="form-group col-md-12 form-group-sm">
            <button class="btn btn-xs btn-info btn-flat" type="button" onclick="functionCancel();">Cancelar</button>
            <button class="btn btn-xs btn-success btn-flat" type="button" onclick="functionSave('#formNoteSubmit');">Salvar</button>
            <button class="btn btn-xs btn-danger btn-flat btn-destroy" style="display: none;" type="button" onclick="functionRemove('#formNoteSubmit', '{{ route('contact-note-destroy') }}');"><i class="fa fa-trash"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="timeline list-results">
                <li class="hidden">
                    <legend>New Web Design <small>21 March, 2014</small></legend>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque scelerisque diam non nisi semper, et elementum lorem ornare. Maecenas placerat facilisis mollis. Duis sagittis ligula in sodales vehicula....</p>
                </li>
            </ul>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function () {
            getData();
        });
        function getData(){
            var listNotes = '';
            var url = "{{route('contact-note-get', [$contact->id])}}";

            $.get(url, function( result ) {
                var json_str = result;
                //loop on json
                json_str.forEach(function(data) {
                    listNotes += '<li class="tlid" id="'+data.id+'"><h5>Por: ' + data.user.name + ' <small class="pull-right">'+data.created_at +'</small></h5><span id="span'+data.id+'">' + data.note + '</span></li>';
                });
                $('.list-results').html(listNotes);
            });
        }

        $( document ).delegate( ".tlid", "click", function() {
            $('.tlid').removeClass('selectedtl');

            $('#formNoteSubmit').attr('action', "{{route('contact-note-update')}}");
            $('#note_id').val($(this).attr('id'));
            $('#txt_note').val($('#span'+$(this).attr('id')).text());

            $('#'+$(this).attr('id')).addClass('selectedtl');

            $('.btn-destroy').show();
            scrollToDiv('body');
        });

        function functionCancel() {
            $('#txt_note').val('');
            $('#note_id').val('');
            $('#formNoteSubmit').attr('action', "{{route('contact-note-store')}}");
            $('.tlid').removeClass('selectedtl');
            $('.btn-destroy').hide();
        }

    </script>
@endpush