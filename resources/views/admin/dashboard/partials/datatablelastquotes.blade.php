<div class="col-md-6">
    <div class="box" style="min-height: 200px;max-height: 200px;overflow:hidden;">
        <div class="box-header with-border">
            <h3 class="box-title">Últimos orçamentos solicitados</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-condensed table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-center">#</th>
                                <th class="col-md-7 text-center">NOME DO CONTATO</th>
                                <th class="col-md-2 text-center">TELEFONE</th>
                                <th class="hidden-xs col-md-2 text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($quotes->take(3) as $quote)
                            <tr>
                                <td class="col-md-1 text-center"><a href="{{route('quote-edit', [$quote->id])}}" class="btn btn-flat btn-xs bg-info"><i class="fa fa-search"></i></a></td>
                                <td class="col-md-7">{{$quote->name}}</td>
                                <td class="col-md-2 text-center">{{$quote->phone}}</td>
                                <td class="hidden-xs col-md-2 text-center">{{$quote->status->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>