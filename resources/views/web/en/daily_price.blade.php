@extends('web.en.en_app')

    @section('content')
		<header class="price-header">
			<div class="container">
				<div class="row">
					<h1 class="page-title">The price list <br>
						of building materials</h1>
					
				</div>
			</div>
		</header>
		
<!--		products price table-->
		<section class="prices-page padding">
			<div class="container">
				
<!--				steel prices-->
				<?php
				$c=0;
				?>

				@foreach ($categories as $category)
			<div class="steel-prices" id="{{$category->id}}">
					<div class="text-center head-div">
						<h1 class="header"> {{$category->en_title}} </h1>
						<span class="after-head"><i class="fas fa-dollar-sign"></i></span>
					</div>
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1 table-responsive">
							<table class="table table-responsive table-hover">
							<thead>
								<tr>
									<td> company name</td>
									<td> product name</td>
									<td> price today</td>
									<td> price yesterday </td>
									<td>price before yesterday</td>

								</tr>
							</thead>
							<tbody>
									
								@foreach ($category->products as $product)
								<tr>
	
									<td>{{$product->company_name}} </td>
									<td>{{$product->en_title}} </td>
	
									@if(isset($product->price) )
									<td>{{$product->price->price_today}} </td>
									<td>{{$product->price->price_yesterday}} </td>
									<td>{{$product->price->price_before_yesterday}} </td>
									@else
									<td></td>
									<td></td>
									<td></td>
									@endif
	
														
								</tr>
								@endforeach
						
							</tbody>
						</table>

						</div>
					</div>
				</div>
				<?php
				$c++;
				?>
				@endforeach	
				

				
			</div>
		</section>
		
		<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>
	@endsection