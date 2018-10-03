<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-clock-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Aprovação</span>
                <span class="info-box-number">{{$approvals->count()}}</span>
            </div>
            <!-- /.info-box-content -->
            <a href="{{route('customer-documents', ['approval'])}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-commenting-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Diversos</span>
                <span class="info-box-number">{{$severals->count()}}</span>
            </div>
            <!-- /.info-box-content -->

            <a href="{{route('customer-documents', ['several'])}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-dollar"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Financeiros</span>
                <span class="info-box-number">{{$financials->count()}}</span>
            </div>
            <!-- /.info-box-content -->

            <a href="{{route('customer-documents', ['financial'])}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-envelope-o"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Suporte</span>
                <span class="info-box-number">{{$supports->count()}}</span>
            </div>
            <!-- /.info-box-content -->

            <a href="{{route('customer-supports')}}" class="small-box-footer">Ver <i class="fa fa-arrow-circle-right"></i></a>
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->


</div>