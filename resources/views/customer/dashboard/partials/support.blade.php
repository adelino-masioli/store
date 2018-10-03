<div class="col-md-6">
    <div class="box box-warning" style="min-height: 200px;max-height: 200px;overflow:hidden;">
        <div class="box-header with-border">
            <h3 class="box-title">Chamados de suporte</h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-condensed table-hover table-striped" style="width: 100%;">
                        <thead>
                        <tr>
                            <th class="col-md-1 text-center">#</th>
                            <th class="col-md-9 text-center">ASSUNTO DO CHAMADO</th>
                            <th class="hidden-xs col-md-2 text-center">STATUS</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($supports->take(3) as $support)
                            <tr>
                                <td class="col-md-1 text-center"><a href="{{route('customer-support-show', [base64_encode($support->id)])}}" class="btn btn-flat btn-xs bg-info"><i class="fa fa-search"></i></a></td>
                                <td class="col-md-9">{{$support->name}}</td>
                                <td class="hidden-xs col-md-2 text-center">{{$support->status->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>