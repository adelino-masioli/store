<form action="{{route('contact-attachment-store')}}" method="post"  id="formAttachmentSubmit" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="id" value="{{$contact->id}}">
    <input type="hidden" name="attachment_id" id="attachment_id">
    <input type="hidden" name="getdata" id="getdata" value="true">

    <div class="row">
        <div class="col-md-7">
            <div class="form-group">
                <label for="txt_name_attachment">Título da mídia(Servirá como a tag ALT)<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="txt_name_attachment" name="name" placeholder="Título do banne" required>
            </div>
        </div>

        <div class="col-md-5">
            <div class="form-group">
                <label for="name">Arquivo[JPG,JPEG,PNG,PDF,DOC,DOCX]<span class="text-danger">*</span></label>
                <input type='file' id="image" name="file"  class="filestyle" data-btnClass="btn-default"  data-text="Selecionar arquivo"/>
            </div>
        </div>

        <div class="col-md-12">
            <div class="form-group">
                <label for="description">Descrição</label>
                <textarea  class="form-control" name="description" id="txt_description" placeholder="Descrição" rows="2"></textarea>
            </div>
        </div>
        <div class="form-group col-md-12 form-group-sm">
            <button class="btn btn-xs btn-warning btn-flat" type="button" onclick="functionCancel();">Cancelar</button>
            <button class="btn btn-xs btn-info btn-flat" type="button" onclick="functionSave('#formAttachmentSubmit');">Salvar</button>
            <button class="btn btn-xs btn-danger btn-flat btn-destroy-attachment" style="display: none;" type="button" onclick="functionRemove('#formAttachmentSubmit', '{{ route('contact-attachment-destroy') }}');"><i class="fa fa-trash"></i></button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="timeline list-results-attachmentSubmit"></ul>
        </div>
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function () {
            getDataAttachement();
        });
        function getDataAttachement(){
            var listNotes = '';
            var url = "{{route('contact-attachment-get', [$contact->id])}}";

            $.get(url, function( result ) {
                var json_str = result;
                //loop on json
                json_str.forEach(function(data) {
                    var url_download = "{{route('contact-attachment-download', null)}}";

                    listNotes += '<li class="tlid" id="'+data.id+'">' +
                        '<h5><span id="name'+data.id+'">' + data.name + '</span> <small class="pull-right">'+data.created_at +'</small></h5>' +
                        '<span id="description'+data.id+'">' + data.description + '</span>' +
                        '<p><a href="'+url_download+'/'+data.file+'"><i class="fa fa-paperclip"></i> Baixar</a></p>' +
                        '</li>';
                });
                $('.list-results-attachmentSubmit').html(listNotes);
            });
        }

        $( document ).delegate( ".tlid", "click", function() {
            $('.tlid').removeClass('selectedtl');

            $('#formAttachmentSubmit').attr('action', "{{route('contact-attachment-update')}}");
            $('#attachment_id').val($(this).attr('id'));
            $('#txt_name_attachment').val($('#name'+$(this).attr('id')).text());
            $('#txt_description').val($('#description'+$(this).attr('id')).text());

            $('#'+$(this).attr('id')).addClass('selectedtl');

            $('.btn-destroy-attachment').show();
            scrollToDiv('body');
        });

        function functionCancel() {
            $('#txt_name_attachment').val('');
            $('#txt_description').val('');
            $('#attachment_id').val('');
            $('#formAttachmentSubmit').attr('action', "{{route('contact-attachment-store')}}");
            $('.tlid').removeClass('selectedtl');
            $('.btn-destroy-attachment').hide();
        }

    </script>
@endpush