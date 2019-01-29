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
				$c=1;
				?>

				@foreach ($categories as $category)
				<div class="steel-prices" id="steel">
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
							
									
								
									
									@if(!empty( $data['category'.$c] ))
										
										@for ($i = 0; $i < count($data['category'.$c]) -2 ; $i++)
										<tr>							
										
											
											<td>	{{1}} </td>
												
																	
										
											
											<td>		{{$data['category'.$c][$i]->en_title}} </td>
													
																	
										
											
											<td>	{{$data['category'.$c][$i]->price}} </td>
											
												@if(!empty( $data['category'.$c]['yesterDayPrice'][$i]->price )  ) 
											<td>	{{$data['category'.$c]['yesterDayPrice'][$i]->price }} </td>
												@endif
												@if(!empty( $data['category'.$c]['beforeYesterDayPrice'][$i]->price )  ) 
											<td>	{{$data['category'.$c]['beforeYesterDayPrice'][$i]->price}} </td>
											 	@endif
												
									     </tr>
										@endfor
											
										<?php $c++;?>
										
									@endif
									
									
							</tbody>
						</table>

						</div>
					</div>
				</div>
				@endforeach	
				

				
			</div>
		</section>
		
		<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>
	@endsection