@extends('web.en.en_app')

    @section('content')
        
		<header class="service-header">
			<div class="container">
				<div class="row">
					<h1 class="page-title">Join Us</h1>
				</div>
			</div>
		</header>
		
<!--		join us section-->
		<section class="join">
			<div class="alert alert-success">
				<strong>Success!</strong>  {{session()->get('status')}}
			</div>
			<div class="container">
				<div class="text-center head-div">
					<h1 class="header wow bounceInUp" data-wow-duration="2s"> Join Us</h1>
					<span class="after-head"><i class="fas fa-pen-square fa-2x"></i></span>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<form action="{{url('en/join_us')}}" method="POST">
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
							<div class="form-group">
							    <label for="name">Name:</label>
							    <input type="text" class="form-control" value="{{old('name')}}" name="name" id="name" >
							 </div>
							 
							<div class="form-group">
							    <label for="name"> Address:</label>
							    <input type="text" class="form-control"  value="{{old('address')}}"  name="address" id="address" >
							 </div>
							
							<div class="form-group">
							    <label for="name"> Phone Numbers:</label>
							    <input type="number" class="form-control" value="{{old('phone')}}"  name="phone" id="phone" >
							 </div>
							
							  <div class="form-group">
							    <label for="email">E-mail:</label>
							    <input type="email" class="form-control" value="{{old('email')}}"  name="email" id="email" >
							  </div>
							
							<div class="form-group">
							    <label for="name"> Job description:</label>
							    <input type="text" class="form-control" name="job" value="{{old('job')}}"  id="job" >
							 </div>
							
							<div class="text-center button">
								<button type="submit" class="btn btn-default hvr-grow">Send</button>
							</div>
						</form>  
					</div>
				</div>
			</div>
		</section>
		
		<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>
@endsection