@extends('web.ar.ar_app')

    @section('content')


		<header>
			<div class="container">
				<div class="row">
					<h1 class="page-title"> تواصل معنا</h1>
				</div>
			</div>
		</header>
<!--		contacts section -->
		<section class="contacts-page">
			<div class="container">
				<div class="row">
					<div class="text-center head-div">
						<h1 class="header wow bounceInUp" data-wow-duration="2s"> تواصل معنا </h1>
						<span class="after-head"><i class="fas fa-phone-square"></i></span>
					</div>
					<div class="col-sm-4 item wow fadeIn" data-wow-duration="2s" >
						<img src="{{asset('resources/assets/site/images/location-icon.png')}}" class="pull-right" alt="location">
						<div class="content">
							<h3 class="title">العنوان</h3>
							<p class="details"><strong> المقر الإداري : </strong> {{$pref->arAddress}}</p>
							<p class="details"><strong>المخزن الرئيسي : </strong> {{$pref->arMainAddress}}</p>
						</div>
					</div>
					<div class="col-sm-4 item wow fadeIn" data-wow-duration="2s" data-wow-delay="0.5s">
						<img src="{{asset('resources/assets/site/images/phone-icon.png')}}" class="pull-right" alt="phone-icon">
						<div class="content">
							<h3 class="title">تليفون</h3>
							<p class="details"><strong>محمول: </strong>{{$pref->phone}} </p>
							<p class="details"><strong>ارضى : </strong>2143339 / 088</p>
						</div>
					</div>
					<div class="col-sm-4 item wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
						<img src="{{asset('resources/assets/site/images/email-icon.png')}}" class="pull-right" alt="email-icon">
						<div class="content">
							<h3 class="title">ايميل : </h3>
						<p class="details">{{$pref->mainEmail}}</p>
						</div>
					</div>
				</div>
			</div>
		</section>
		
		<!--        contact form-->
        <section class="form padding wow fadeIn" data-wow-duration="2s" data-wow-delay="1s">
			@if(session()->get('status'))
				<div class="alert alert-success">

				<strong>Success {{session()->get('status')}}</strong>

			</div>
			@endif
            <div class="container">
                <!-- CONATACT-FORM -->
                <div id="contact-form" class="col-sm-12">
                    <form class="contact-form-area" method="post" action="{{url('ar/contact')}}">
						{{csrf_field()}}
						@if ($errors->any())
							<div class="alert alert-danger">
								<ul>
									@foreach ($errors->all() as $error)
										<li>{{ $error }}</li>
									@endforeach
								</ul>
							</div>
						@endif
						<div class="row">
                            <div class="form-group col-md-12">
                                <input type="text" name="name" value="{{old('name')}}" class="form-control" placeholder="الاسم" id="form-name" required>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <input type="text" name="phone" value="{{old('phone')}}" class="form-control" placeholder="التليفون" id="form-phone" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <input type="text" name="email" value="{{old('email')}}" class="form-control" placeholder="الايميل" id="form-email" required>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-sm-12">
                            <textarea rows="8" placeholder="اترك رسالتك" value="{{old('text')}}" class="form-control" id="form-msg" name="text" required></textarea>
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