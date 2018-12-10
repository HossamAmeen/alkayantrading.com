
@extends('layouts.ar_app')
	 @section('content')
		  
			
		<div class="bannercontainer">
			<div class="banner">
				<ul>
				<!-- THE BOXSLIDE EFFECT EXAMPLES  WITH LINK ON THE MAIN SLIDE EXAMPLE -->

				 <li data-transition="papercut" data-slotamount="7">
				   <img src="images/1.jpg">
				   <div class="caption lfl big_white"  data-x="50" data-y="250" data-speed="800" data-start="1700" data-easing="easeInOut" style="font-size: 40px; color:#324d5c;"> شركة كيان </div>
					 
				   <div class="caption lfl big_orange"  data-x="0" data-y="300" data-speed="800" data-start="2000" data-easing="easeInOut" style="font-size: 40px; color:#c9a96b;"> لتوريد مواد البناء </div>
					 
				 </li>
					
				<li data-transition="papercut" data-slotamount="7">
				   <img src="images/2.png">
				   
				   <div class="caption lfl big_orange"  data-x="40" data-y="200" data-speed="800" data-start="2000" data-easing="easeInOut" style="font-size: 40px; color:#000;">
					   <img src='images/slide21_txt.png' alt="slogan">
					</div>
				 </li>
					
				<li data-transition="papercut" data-slotamount="7">
				   <img src="images/bg-3.png" alt="slider-bg">
				   	<div class="caption lfl big_orange"  data-x="150" data-y="200" data-speed="800" data-start="2000" data-easing="easeInOut" style="font-size: 40px; color:#000;">
						<img src='images/slide3_txt.png' alt="slogan">
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
							شركة كيان <span> لتوريد مواد البناء </span>
						</h1>
						<div class="content wow fadeIn" data-wow-duration="2s">
							<p> 
								شركة كيان لتوريد جميع مواد البناء (حديد - اسمنت - الرمل - الزلط السن بجميع مقاساته و الاضافات الكيماوية من كبرى شركات الكيماويات ) 
								وادارة وتشغيل اساطيل النقل البرى
								بالاضافه الى تشغيل وادارة محطات الخرسانه الجاهزه  ونقدم خدمات متنوعه فى هذا المجال مثل
							</p>
							<ul class="list-unstyled">
								<li>- توريد الخامات ( الاسمنت السايب - الرمل - الزلط السن بجميع مقاساته و الاضافات الكيماوية من كبرى شركات الكيماويات ) </li>
								<li>- الصيانة الميكانيكية</li>
								<li>- تسويق الخرسانة </li>
							</ul>
						</div>
					</div>
					<div class="col-md-6" >
						<div class="text-center wow fadeIn" data-wow-duration="2s">
							<img src="images/building-information.jpg" class="img-responsive" alt="building-info">
						</div>
					</div>
				</div>
			</div>
		</section>
		
<!--		our products-->
		<section class="products padding">
			<div class="container">
				<div class="text-center head-div">
					<h1 class="header wow bounceInUp" data-wow-duration="2s">خدماتنا </h1>
					<span class="after-head"><i class="fas fa-bookmark fa-2x"></i></span>
				</div>
				<div class="row">
					@foreach ($services as $service)
					<div class="col-md-4 col-sm-6 col-xs-10 col-xs-offset-1 col-sm-offset-0 wow fadeInUp" 
					     data-wow-duration="2s">
						<div class="product-item">
							<div class="opacity"></div>
							<img src="{{$service->img}}" alt="{{$service->arAddress}}" class="img-responsive item-img">
							<div class="content">
								<h4> {{ $service->arAddress}}</h4>
								@if($service->category_id !=NULL)
								<p class="price-link text-center"><a href="{{ url('ar_daily_price')}}">شاهد الاسعار اليوميه</a></p>
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
					<p>توفر شركة كيان لتوريد مواد البناء لعملائها الكرام التعرف على اسعار المنتجات بشكل يومى من خلال الموقع لتوفير للعميل المقارنه بين اسعارنا واسعار السوق</p>
					<div class="button">
						<a href="#" class="hvr-grow">قائمة الاسعار </a>
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
				<div class="swiper-slide">
				 	<img src="images/ehab.jpg" alt="client-review">
					<div class="content">
						<p class="review">من الناس المحترمه جدا في السوق.</p>
						<p class="name">Ehab Shehata</p>
						<p class="face"><a target="_blank" href="https://www.facebook.com/ehab.shehata.399?fref=nf&__tn__=m-R">
							<i class="fab fa-facebook-f"></i></a></p>
					</div>
				 </div>
				<div class="swiper-slide">
				 	<img src="images/hany.jpg" alt="client-review">
					<div class="content">
						<p class="review">معاملة محترمة ,
									اقل اسعار فى السوق ,
									التزام تام بالمواعيد .</p>
						<p class="name"> Hany Abokresha</p>
						<p class="face">
							<a target="_blank" href="https://www.facebook.com/hany.abokresha?fref=nf&__xts__%5B0%5D=68.ARDqHMF3w0GN0oQzbm7HEVAAmpQlKF2arHmRsCUiRiK0gtEgUu6HSKMeAdjQB9LKsr_9JlQZZ0GwI3V5wxcoX_HQmH280ii5oE8S99MHq_m-pS7uqjQ3SZ6u9soL1cbSolRmC1AtMzeXpo6a79VhWcNogx0ZnbvlNi7a6nEhk93YQEm-FuRFSQ&__tn__=m-R">
								<i class="fab fa-facebook-f"></i>
							</a>
						</p>
					</div>   
				 </div>
				<div class="swiper-slide">
					 <img src="images/omar.jpg" alt="client-review">
					<div class="content">
						<p class="review">It's your best option to build up your future life </p>
						<p class="name"> Omar Elgretly</p>
						<p class="face"><a target="_blank" href="https://www.facebook.com/omar.elgretly?hc_ref=ARSU9HrjVOlqs1udERTzwAQmWh7FL7E0M22Np6l9tV4HVIme3Xs6hdgmuQgIS9KbAis&__xts__[0]=68.ARBBQ-sxhQnGFSEsK7JVzvhPj-HRhCWUycJvdasYvNesFxhQp3In1CB2oBZUWAF1woWSv7DglipeLJ6-4Jo5FLC8FZOksKV_jaU-GltYP_hr_1HdYBLcAlWtnoFVcuVEPKJ9s4LDGQQstGWypvLy4nj3cL2qYdtyHqKzthe-0nc2cNrhStrKxw&__tn__=lC-R"><i class="fab fa-facebook-f"></i></a></p>
					</div>  
				 </div>
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
								<li><strong> المقر الإداري: </strong>{{$pref->arAddress}}</li>
								<li><strong>المخزن الرئيسي: </strong>{{$pref->arMainAddress}}</li>
								<li><strong>تليفون: </strong>{{$pref->phone}}</li>
								<li>
									<strong>صفحات التواصل الاجتماعى : </strong>
									<a href="{{$pref->facebook}}" target="_blank" class="social hvr-grow">
										<i class="fab fa-facebook-f"></i>
									</a>
									<a href="{{$pref->twitter}}" target="_blank" class="social hvr-grow">
										<i class="fab fa-twitter"></i>
									</a>
									<a  href="{{$pref->instgram}}" target="_blank" class="social hvr-grow">
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
			<img src="images/before-footer.png" class="img-responsive">
		</section>
@endsection