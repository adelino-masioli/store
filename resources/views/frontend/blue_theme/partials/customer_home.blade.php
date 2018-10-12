<div class="container">

    <div class="row">

        <div class="col-lg-3 sidebar">
            <div class="title-sidebar"><i class="fa fa-list"></i> MENU</div>
            <ul class="sidebar-list">
                <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Meus dados</a></li>
                <li><a href="#"><i class="fa fa-dollar" aria-hidden="true"></i> Meus pedidos</a></li>
                <li><a href="#"><i class="fa fa-question-circle" aria-hidden="true"></i> Suporte</a></li>
                <li><a href="#"><i class="fa fa-sign-out" aria-hidden="true"></i> Sair</a></li>
            </ul>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 products-list">
            <?php //require_once('partials/customer_form.php');?><!-- data-->
            <?php //require_once('partials/customer_order.php');?><!-- order-->
            <?php //require_once('partials/customer_order_detail.php');?><!-- order detail-->
            <?php require_once('partials/customer_support.php');?><!-- support-->
        </div>

    </div><!-- /.row -->


</div><!-- /.container -->