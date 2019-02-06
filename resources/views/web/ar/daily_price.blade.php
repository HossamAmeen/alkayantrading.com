@extends('web.ar.ar_app')

@section('content')
        
		
		<header class="price-header">
			<div class="container">
				<div class="row">
					<h1 class="page-title">قائمة الاسعار اليومية <br>
						لمواد البناء</h1>
					
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
					
				
				<div class="steel-prices" id="steel">
					<div class="text-center head-div">
						<h1 class="header"> {{$category->ar_title}} </h1>
						<span class="after-head"><i class="fas fa-dollar-sign"></i></span>
					</div>
					<div class="row">
						<div class="col-lg-10 col-lg-offset-1 table-responsive">
							<table class="table table-responsive table-hover">
							
								<?php //dd($data2[0]) ?>
								<thead>
										<tr>
											<td>الشركة</td>
											<td> اسم المنتج</td>
											<td> الاسعار اليوم</td>
											<td> الاسعار امس </td>
											<td>الاسعار قبل امس</td>
		
										</tr>
								</thead>
								<tbody>
								@if ($data2[$c]['catname'] == $category->ar_title )
										
										
										
											
										

												
											

												@foreach ($data2[$c]['prices'] as $price)
												<tr>

												<td>{{$price['company_name']}} </td>
												<td>{{$price['title']}} </td>
												<td>{{$price['today']}} </td>
												<td>{{$price['yesterday']}} </td>
												<td>{{$price['beforeYesterday']}} </td>
											</tr>
												@endforeach


										
									
										
										
									
								
								@endif
								
								</tbody>		
                                <?php $c++;?>

							
							
						</table>

						</div>
					</div>
				</div>
				@endforeach

			<!--				steel prices-->
			</div>
		</section>

		<!--		before footer section-->
		<section class="before-footer">
			<img src="{{asset('resources/assets/site/images/before-footer.png')}}" class="img-responsive">
		</section>
@endsection