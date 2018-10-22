<div class="col-md-4">
    <div class="box box-info box-dash" style="height: calc(100vh - 290px);overflow:hidden; margin-bottom: 0px;">
        <div class="box-header with-border">
            <h3 class="box-title">Contatos e Prospecções <a href="{{route('contact-create')}}" class="pull-right text-info"><i class="fa fa-plus-circle text-info"></i> NOVO</a></h3>
        </div>

        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-condensed table-hover table-striped" style="width: 100%;">
                        <thead>
                            <tr>
                                <th class="col-md-1 text-center">#</th>
                                <th class="col-md-9 text-center">NOME DO CONTATO</th>
                                <th class="hidden-xs col-md-2 text-center">STATUS</th>
                            </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="col-md-1 text-center"><a href="#" class="text-info"><i class="fa fa-search text-info"></i></a></td>
                            <td class="col-md-9">João da Silva</td>
                            <td class="hidden-xs col-md-2 text-center">Contato</td>
                        </tr>


                        @foreach($contacts->take(3) as $contact)
                            <tr>
                                <td class="col-md-1 text-center"><a href="{{route('contact-edit', [base64_encode($contact->id)])}}" class="btn btn-flat btn-xs bg-info"><i class="fa fa-search"></i></a></td>
                                <td class="col-md-9">{{$contact->name}}</td>
                                <td class="hidden-xs col-md-2 text-center">{{$contact->status->status}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>