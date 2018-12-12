
  @extends('layouts.ar_app')

  @section('content')
	  
			
		<header class="service-header">
			<div class="container">
				<div class="row">
					<h1 class="page-title">خدماتنا</h1>
				</div>
			</div>
		</header>
		
<!--		join us section-->
		<section class="join">
			<div class="container">
				<div class="text-center head-div">
					<h1 class="header wow bounceInUp" data-wow-duration="2s"> انضم الينا </h1>
					<span class="after-head"><i class="fas fa-pen-square fa-2x"></i></span>
				</div>
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<form action="#">
							<div class="form-group">
							    <label for="name">الاسم بالكامل:</label>
							    <input type="text" class="form-control" name="name" id="name" >
							 </div>
							
							<div class="form-group">
							    <label for="name"> العنوان:</label>
							    <input type="text" class="form-control" name="address" id="address" >
							 </div>
							
							<div class="form-group">
							    <label for="name"> التليفون:</label>
							    <input type="number" class="form-control" name="phone" id="phone" >
							 </div>
							
							  <div class="form-group">
							    <label for="email">الايميل:</label>
							    <input type="email" class="form-control" name="email" id="email">
							  </div>
							
							<div class="form-group">
							    <label for="name"> الوظيفه:</label>
							    <input type="text" class="form-control" name="job" id="job" >
							 </div>
							
							<div class="text-center button">
								<button type="submit" class="btn btn-default hvr-grow">Submit</button>
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