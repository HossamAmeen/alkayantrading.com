@extends('web.en.en_app')

    @section('content')
		<div class="bannercontainer">
			<div class="banner">
				<ul>
				<!-- THE BOXSLIDE EFFECT EXAMPLES  WITH LINK ON THE MAIN SLIDE EXAMPLE -->

				 <li data-transition="papercut" data-slotamount="7">
				   <img src="{{asset('resources/assets/site/images/1.jpg')}}">
				   <div class="caption lfl big_white"  data-x="50" data-y="250" data-speed="800" data-start="1700" data-easing="easeInOut" style="font-size: 40px; color:#324d5c;"> شركة كيان </div>
					 
				   <div class="caption lfl big_orange"  data-x="0" data-y="300" data-speed="800" data-start="2000" data-easing="easeInOut" style="font-size: 40px; color:#c9a96b;"> لتوريد مواد البناء </div>
					 
				 </li>
					
				<li data-transition="papercut" data-slotamount="7">
				   <img src="{{asset('resources/assets/site/images/2.png')}}">
				   
				   <div class="caption lfl big_orange"  data-x="40" data-y="200" data-speed="800" data-start="2000" data-easing="easeInOut" style="font-size: 40px; color:#000;">
					   <img src='{{asset('resources/assets/site/images/slide21_txt.png')}} alt="slogan">
					</div>
				 </li>
					
				<li data-transition="papercut" data-slotamount="7">
				   <img src="{{asset('resources/assets/site/images/bg-3.png')}}" alt="slider-bg">
				   	<div class="caption lfl big_orange"  data-x="150" data-y="200" data-speed="800" data-start="2000" data-easing="easeInOut" style="font-size: 40px; color:#000;">
						<img src='{{asset('resources/assets/site/images/slide3_txt.png')}} alt="slogan">
					</div>
				 </li>
				</ul>
			</div>
		</div>
		
<!--		about section-->
		<section class="about padding">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<h1 class="h1 about-head wow fadeIn" data-wow-duration="2s">
							kayan <span> trading company</span>
						</h1>
						<div class="content wow fadeIn" data-wow-duration="2s">
							<p> 
								It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English.
							</p>
							<ul class="list-unstyled">
								<li>- Many desktop publishing packages and web page editors </li>
								<li>- ipsum' will uncover many web sites still in their infancy.</li>
								<li>- ipsum' will uncover many web sites still in their infancy. </li>
							</ul>
						</div>
					</div>
					<div class="col-md-6" >
						<div class="text-center wow fadeIn" data-wow-duration="2s">
							<img src="{{asset('resources/assets/site/images/building-information.jpg')}}" class="img-responsive" alt="building-info">
						</div>
					</div>
				</div>
			</div>
		</section>
		
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
							<img src="{{asset($service->img)}}" alt="{{$service->en_title}}" class="img-responsive item-img">
							<div class="content">
								<h4> {{ $service->en_title}}</h4>
								@if($service->category_id !=NULL)
								<p class="price-link text-center"><a href="{{ url('en/daily_price/'.$service->category_id )}}"> watch our price</a></p>
								@endif
							</div>
						</div>
					</div>
					@endforeach
				</div>
			</div>
		</section>
		
<!--		prices section-->
		<section class="prices">
			<div class="container">
				<div class="content text-center wow fadeInUp" data-wow-duration="2s" data-wow-delay="0.5s">
					
					<p>
						It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point 
					</p>
					<div class="button">
						<a href="#" class="hvr-grow">price list</a>
					</div>
				</div>
			</div>
		</section>
		
<!--		testimonials section-->
		<section class="testimonials padding">
			<div class="container">
				<!-- Swiper -->
			  <div class="swiper-container">
			    <div class="swiper-wrapper">
				@foreach($reviews as $review)
				<div class="swiper-slide">
				 	<img src="{{asset($review->img)}}" alt="client-review">
					<div class="content">
						<p class="review">{{$review->review}}</p>
						<p class="name">{{$review->name}}</p>

					</div>
				 </div>
				@endforeach

			    </div>
			    <!-- Add Pagination -->
			    <div class="swiper-pagination"></div>
			    
			  </div>
			</div>
		</section>
		
<!--		contacts section -->
		<section class="contacts padding">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="content wow fadeInUp" data-wow-duration="2s">
							<ul class="list-unstyled">
							<li><strong> Address: </strong>{{$pref->enAddress}}</li>
								<li><strong> Our Main Store: </strong>{{$pref->mainAddress}}</li>
								<li><strong>phone numbers: </strong>{{$pref->phone}}</li>
								<li>
									<strong>social media acounts : </strong>
									<a href="{{$pref->facebook}}" target="_blank" class="social hvr-grow">
										<i class="fab fa-facebook-f"></i>
									</a>
									<a href="{{$pref->twitter}}" target="_blank" class="social hvr-grow">
										<i class="fab fa-twitter"></i>
									</a>
									<a href="{{$pref->instgram}}" target="_blank" class="social hvr-grow">
										<i class="fab fa-instagram"></i>
									</a>
									<a href="{{$pref->linkedin}}" target="_blank" class="social hvr-grow">
										<i class="fab fa-linkedin-in"></i>
									</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-md-6">
						<iframe id="map" class=" wow fadeInUp" data-wow-duration="2s" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1774.3094087870259!2d31.185349190142837!3d27.19971482933037!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x14450c0f3023c607%3A0x47922ea4e06c9297!2sAbraj+Elmashtal+Buildings!5e0!3m2!1sar!2seg!4v1535846053997"  frameborder="0" style="border:0" allowfullscreen></iframe>
					</div>
				</div>
			</div>
		</section>
		
<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>

	@endsection	
