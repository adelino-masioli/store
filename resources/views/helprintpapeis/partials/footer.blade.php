<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">

				<div class="col-lg-12">
					<div class="footer_column footer_contact">
						<div class="row">
							<div class="col col-xs-12 col-md-2 logo_container">
								<div class="logo"><a href="{{url('/')}}"><img class="img-fluid" src="{{asset('templates/'.config('app.template'))}}/images/brand_sprintem.png" alt="{{$configuration['name']}}"></a></div>
							</div>
							<div class="col col-xs-12 col-md-7">
								<div class="footer_phone">{{$configuration['phone']}}</div>
								<div class="footer_contact_text">
									<p>{{$configuration['address']}} - {{$configuration['city']}} - {{$configuration['state']}}</p>
								</div>
							</div>
							<div class="col col-xs-12 col-md-3 footer_social text-right">
								<ul>
									<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
									<li><a href="#"><i class="fab fa-twitter"></i></a></li>
									<li><a href="#"><i class="fab fa-youtube"></i></a></li>
									<li><a href="#"><i class="fab fa-google"></i></a></li>
									<li><a href="#"><i class="fab fa-vimeo-v"></i></a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</footer>