<div class="row box-dashboard">
    <div class="col-md-2 col-sm-4 col-xs-12">
        <div class="box box-info">
            <div class="box-header with-border">Contatos/Prospecções</div>
            <div class="box-body"><span class="badge bg-aqua">{{$contacts->count()}}</span></div>
            <div class="box-footer">
                <a href="{{route('contacts')}}" >Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-2 col-sm-4 col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">Orçamentos</div>
            <div class="box-body"><span class="badge bg-blue">{{$contacts->count()}}</span></div>
            <div class="box-footer">
                <a href="{{route('contacts')}}" >Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-2 col-sm-4 col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">Clientes</div>
            <div class="box-body"><span class="badge badge-dark">{{$contacts->count()}}</span></div>
            <div class="box-footer">
                <a href="{{route('contacts')}}" >Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-2 col-sm-4 col-xs-12">
        <div class="box box-success">
            <div class="box-header with-border">Pedidos</div>
            <div class="box-body"><span class="badge bg-green">{{$orders->count()}}</span></div>
            <div class="box-footer">
                <a href="{{route('orders')}}" >Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


    <div class="col-md-2 col-sm-4 col-xs-12">
        <div class="box box-warning">
            <div class="box-header with-border">Produtos</div>
            <div class="box-body"><span class="badge bg-yellow">{{$products->count()}}</span></div>
            <div class="box-footer">
                <a href="{{route('products')}}" >Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <div class="col-md-2 col-sm-4 col-xs-12">
        <div class="box box-danger">
            <div class="box-header with-border">Documentos</div>
            <div class="box-body"><span class="badge bg-red">{{$documents->count()}}</span></div>
            <div class="box-footer">
                <a href="{{route('documents')}}" >Ver <i class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

</div>