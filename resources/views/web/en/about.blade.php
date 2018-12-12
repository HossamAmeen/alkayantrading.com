@extends('layouts.en_app')

    @section('content')
		<header>
			<div class="container">
				<div class="row">
					<h1 class="page-title">About Us</h1>
				</div>
			</div>
		</header>
		
		
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
			
<!--		team members -->
		<section class="members">
			<div class="container">
				<div class="row">
					<div class="text-center head-div">
						<h1 class="header wow bounceInUp" data-wow-duration="2s" >Our team work</h1>
						<span class="after-head"><i class="fas fa-users"></i></span>
					</div>
					<div class="col-md-4">
						<div class="item wow fadeIn" data-wow-duration="2s">
							<img src="{{asset('resources/assets/site/images/member.jpeg')}}" class="img-responsive">
							<div class="content text-center">
								<p class="name">Mahmoud Kamal</p>
								<p class="position">the chief officer</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
							<img src="{{asset('resources/assets/site/images/member.jpeg')}}" class="img-responsive">
							<div class="content text-center">
								<p class="name">Mahmoud Kamal</p>
								<p class="position">the chief officer</p>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<div class="item wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
							<img src="{{asset('resources/assets/site/images/member.jpeg')}}" class="img-responsive">
							<div class="content text-center">
								<p class="name">Mahmoud Kamal</p>
								<p class="position">the chief officer</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>
@endsection