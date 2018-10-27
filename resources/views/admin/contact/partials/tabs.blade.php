<!-- Custom Tabs -->
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab_note" data-toggle="tab"><i class="fa fa-pencil"></i> Anotações</a></li>
        <li><a href="#tab_attachment" data-toggle="tab"><i class="fa fa-paperclip"></i> Arquivos</a></li>
        <li><a href="#tab_quote" data-toggle="tab"><i class="fa fa-dollar"></i> Orçamentos</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab_note">
            @if(isset($contact))
                @include('admin.contact.partials.form_note')
            @else
                <p class="text-center" style="padding: 10px;"><i class="fa fa-exclamation-triangle"></i> Aguardando criar o contato.</p>
            @endif
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_attachment">
            @if(isset($contact))
                @include('admin.contact.partials.form_attachment')
            @else
                <p class="text-center" style="padding: 10px;"><i class="fa fa-exclamation-triangle"></i> Aguardando criar o contato.</p>
            @endif
        </div>
        <!-- /.tab-pane -->
        <div class="tab-pane" id="tab_quote">
            @if(isset($contact))
                @include('admin.contact.partials.form_quote')
            @else
                <p class="text-center" style="padding: 10px;"><i class="fa fa-exclamation-triangle"></i> Aguardando criar o contato.</p>
            @endif
        </div>
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
            getDataQuote();
        }
    </script>
@endpush