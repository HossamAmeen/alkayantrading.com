@extends('web.ar.ar_app')

    @section('content')
		
		
        
		<header>
			<div class="container">
				<div class="row">
					<h1 class="page-title">من نحن</h1>
				</div>
			</div>
		</header>
		
<!--		aboutus section -->
		
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
							<img src="{{asset('resources/assets/site/images/building-information.jpg')}}" class="img-responsive" alt="building-info">
						</div>
					</div>
				</div>
			</div>
		</section>
		
<!--		team members -->
		<section class="members">
			<div class="container">
				<div class="row">
					<div class="text-center head-div">
						<h1 class="header wow bounceInUp" data-wow-duration="2s" >فريق العمل  </h1>
						<span class="after-head"><i class="fas fa-users"></i></span>
					</div>
					@foreach($teams as $team)
					<div class="col-md-4">
						<div class="item wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
							<img src="{{asset($team->img)}}" class="img-responsive">
							<div class="content text-center">
								<p class="name">{{$team->name}}</p>
								<p class="position">{{$team->job}}</p>
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