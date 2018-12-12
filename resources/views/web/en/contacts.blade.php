
	
@extends('layouts.en_app')
  @section('content')		
		<header>
			<div class="container">
				<div class="row">
					<h1 class="page-title">Contact Us</h1>
				</div>
			</div>
		</header>
		
<!--		contacts section -->
		<section class="contacts-page">
			<div class="container">
				<div class="row">
					<div class="text-center head-div">
						<h1 class="header wow bounceInUp" data-wow-duration="2s"> Contact Us</h1>
						<span class="after-head"><i class="fas fa-phone-square"></i></span>
					</div>
					<div class="col-sm-4 item wow fadeIn" data-wow-duration="2s" >
						<img src="{{asset('resources/assets/site/images/location-icon.png')}}" class="pull-left" alt="location">
						<div class="content">
							<h3 class="title">Address</h3>
							<p class="details"><strong> Main Location : </strong> {{$pref->enMainAddress}}</p>
							<p class="details"><strong>Main Store : </strong>{{$pref->enAddress}}</p>
						</div>
					</div>
					<div class="col-sm-4 item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
						<img src="{{asset('resources/assets/site/images/phone-icon.png')}}" class="pull-left" alt="phone-icon">
						<div class="content">
							<h3 class="title">Phone Numbers</h3>
							<p class="details"><strong>mobile: </strong>{{$pref->phone}} </p>
							<p class="details"><strong> : </strong>2143339 / 088</p>
						</div>
					</div>
					<div class="col-sm-4 item wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
						<img src="{{asset('resources/assets/site/images/email-icon.png')}}" class="pull-left" alt="email-icon">
						<div class="content">
							<h3 class="title">E-mail : </h3>
							<p class="details">mahmoudkamal01099@gmail.com</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!--        contact form-->
        <section class="form padding wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
            <div class="container">
                <!-- CONATACT-FORM -->
                <div id="contact-form" class="col-sm-12">
                    <form class="contact-form-area" method="post" action="/contact">
                        <div class="row"> 
                            <div class="form-group col-md-12">
                                <input type="text" name="Name" class="form-control" placeholder="enter your name" id="form-name" required>
                            </div>
                        </div>
                        <div class="col-sm-12"> 
                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <input type="text" name="phone" class="form-control" placeholder="phone number" id="form-phone" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="email" class="form-control" placeholder="E-mail" id="form-email" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12">
                            <textarea  name="text" rows="8" placeholder="Leave a Message" class="form-control" id="form-msg" name="message" required></textarea>
                            <input type="submit" name="ارسال" value="submit" id="submit" class="btn btn-default hvr-grow">
                        </div>
                    </form>
                </div>
            </div>
        </section>
        
		
		<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>
	
		@endsection			