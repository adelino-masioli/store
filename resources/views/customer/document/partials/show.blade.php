<div class="row">
    <div class="col-md-12">
        <legend>{{$document->name}} <small class="pull-right" style="font-size: 12px;position: relative;top:8px;"><i class="fa fa-clock-o"></i> {{date_br($document->created_at)}}</small></legend>

        <div>
            {!! $document->description !!}
        </div>

        <hr>

        <p>
            <a class="btn btn-flat btn-xs bg-yellow" href="{{route('customer-document-download', base64_encode($document->id))}}"><i class="fa fa-download"></i> Baixar arquivo</a>
        </p>
    </div>
</div>