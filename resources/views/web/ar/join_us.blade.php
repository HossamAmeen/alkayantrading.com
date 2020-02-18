
  @extends('web.ar.ar_app')

  @section('content')
	  
			
		<header class="service-header">
			<div class="container">
				<div class="row">
					<h1 class="page-title">انظم إلينا</h1>
				</div>
			</div>
		</header>
		
<!--		join us section-->
		<section class="join">
			@if(session()->get('status'))
			<div class="alert alert-success">
				<strong>Success  {{session()->get('status')}}</strong>
			</div>
			@endif
				@if ($errors->any())
					<div class="alert alert-danger">
						<ul>
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif
			<div class="container">
				<div class="text-center head-div">
					<h1 class="header wow bounceInUp" data-wow-duration="2s"> انضم الينا </h1>
					<span class="after-head"><i class="fas fa-pen-square fa-2x"></i></span>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<form action="{{url('ar/join-us')}}" method="post">
							{{csrf_field()}}
							<div class="form-group">
							    <label for="name">الاسم بالكامل:</label>
							    <input type="text" class="form-control" name="name" id="name"   value="{{old('name')}}" required>
							 </div>
							
							<div class="form-group">
							    <label for="name"> العنوان:</label>
							    <input type="text" class="form-control" name="address" id="address" value="{{old('address')}}" required>
							 </div>
							
							<div class="form-group">
							    <label for="name"> التليفون:</label>
							    <input type="number" class="form-control" name="phone" id="phone"    value="{{old('phone')}}" required>
							 </div>
							
							  <div class="form-group">
							    <label for="email">الايميل:</label>
							    <input type="email" class="form-control" name="email" id="email"  value="{{old('email')}}" required>
							  </div>
							
							<div class="form-group">
							    <label for="name"> الوظيفه:</label>
							    <input type="text" class="form-control" name="job" id="job"  value="{{old('job')}}" required>
							 </div>
							
							<div class="text-center button">
								<button type="submit" class="btn btn-default hvr-grow">إرسال</button>
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