<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-cube"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Produtos</span>
                <span class="info-box-number">{{$products->count()}}</span>
            </div>
            <!-- /.info-box-content -->
            <a href="{{route('products')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Pedidos</span>
                <span class="info-box-number">{{$orders->count()}}</span>
            </div>
            <!-- /.info-box-content -->

            <a href="{{route('orders')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-envelope-open-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Contatos</span>
                <span class="info-box-number">{{$contacts->count()}}</span>
            </div>
            <!-- /.info-box-content -->

            <a href="{{route('contacts')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-file-text-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Documentos</span>
                <span class="info-box-number">{{$documents->count()}}</span>
            </div>
            <!-- /.info-box-content -->

            <a href="{{route('documents')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


</div>