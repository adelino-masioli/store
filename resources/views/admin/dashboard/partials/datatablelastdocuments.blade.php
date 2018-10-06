<div class="col-md-12">
    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">Últimos documentos compartilhados</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-condensed table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="hidden-xs col-md-1 text-center">AÇÃO</th>
                                <th class="col-md-3 text-center">NOME DO ARQUIVO</th>
                                <th class="col-md-2 text-center">NOME DO CLIENTE</th>
                                <th class="col-md-1 text-center">TIPO</th>
                                <th class="col-md-1 text-center">BAIXAR</th>
                                <th class="col-md-1 text-center">EXTENSÃO</th>
                                <th class="col-md-1 text-center">CRIADO</th>
                                <th class="col-md-1 text-center">MODIFICADO</th>
                                <th class="hidden-xs col-md-1 text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($documents->take(3) as $document)
                            <tr>
                                <td class="text-center"><a href="{{route('document-edit', [base64_encode($document->id)])}}" class="btn btn-flat btn-xs bg-info"><i class="fa fa-search"></i></a></td>
                                <td>{{$document->name}}</td>
                                <td>{{\App\Models\Document::user($document->id)}}</td>
                                <td>{{$document->type->type}}</td>
                                <td class="text-center">
                                    @if($document->file)
                                        <a href="{{route('document-download', [base64_encode($document->file)])}}"  title="Baixar" class="btn bg-green btn-xs"><i class="fa fa-download"></i></a>
                                    @else
                                        <a href="javascript:void(0);"  title="Baixar" class="btn bg-green btn-xs disabled"><i class="fa fa-close"></i></a>
                                    @endif
                                </td>
                                <td>{{$document->extension}}</td>
                                <td>{{format_date($document->created_at)}}</td>
                                <td class="text-center">{{format_date($document->updated_at)}}</td>
                                <td class="hidden-xs text-center">{{$document->status->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>