<div class="container contat-box">
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
            <i class="fa fa-map-o"></i>
            <h3>ENDEREÇO</h3>
            <p>{{$config_site->address}}, {{$config_site->number}} - {{$config_site->district}}</p>
            <p>{{$config_site->city}} - {{$config_site->state}}</p>
            <p>{{$config_site->zipcode}}</p>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
            <i class="fa fa-envelope-o"></i>
            <h3>E-MAIL</h3>
            <p>{{$config_site->email}}</p>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
            <i class="fa fa-globe"></i>
            <h3>SITE</h3>
            <p>{{$config_site->url}}</p>
        </div>

        <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" data-aos="fade-up" data-aos-delay="50" data-aos-easing="ease-in-out">
            <i class="fa fa-phone"></i>
            <h3>TELEFONE</h3>
            <p>{{$config_site->phone}}</p>
        </div>
    </div><!-- /.row -->
</div>