@extends('web.en.en_app')

    @section('content')
		<header class="service-header">
			<div class="container">
				<div class="row">
					<h1 class="page-title">Our Services</h1>
				</div>
			</div>
		</header>
		
	<!--		our products-->
		<section class="products padding">
			<div class="container">
				<div class="text-center head-div">
					<h1 class="header wow bounceInUp" data-wow-duration="2s"> Services </h1>
					<span class="after-head"><i class="fas fa-bookmark fa-2x"></i></span>
				</div>
				<div class="row">
					@foreach ($services as $service)
						<div class="col-md-4 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp"
							 data-wow-duration="2s">
							<div class="product-item">
								<div class="opacity"></div>
								<img src="{{asset('resources/assets/site/'.$service->img)}}" alt="{{$service->en_title}}" class="img-responsive item-img">
								<div class="content">
									<h4> {{ $service->en_title}}</h4>
									@if($service->category_id !=NULL)
										<p class="price-link text-center"><a href="{{ url('en_daily_price')}}"> watch our price</a></p>
									@endif
								</div>
							</div>
						</div>
					@endforeach
				</div>
			</div>
		</section>
	
		
		<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>
@endsection	