<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_note" data-toggle="tab"><i class="fa fa-pencil"></i> Anotações</a></li>
        <li><a href="#tab_attachment" data-toggle="tab"><i class="fa fa-paperclip"></i> Arquivos</a></li>
        <li><a href="#tab_quote" data-toggle="tab"><i class="fa fa-dollar"></i> Orçamentos</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_note">
            @if($contact)
                @include('admin.contact.partials.form_note')
            @else
                <i class="fa fa-exclamation-triangle"></i> Aguardando criar o contato.
            @endif
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_attachment">
            @if($contact)
                @include('admin.contact.partials.form_attachment')
            @else
                <i class="fa fa-exclamation-triangle"></i> Aguardando criar o contato.
            @endif
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_quote">3</div>
        <!-- /.tab-pane -->
    </div>
    <!-- /.tab-content -->
</div>
<!-- nav-tabs-custom -->

@push('scripts')
    <script>
        function  getData() {
            getDataNote();
            getDataAttachement();
        }
    </script>
@endpush