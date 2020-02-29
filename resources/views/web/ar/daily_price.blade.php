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
							
							@foreach ($category->products as $product)
							<tr>

								<td>{{$product->company_name}} </td>
								<td>{{$product->ar_title}} </td>

								@if(isset($product->priceProduct) )
								<td>{{$product->priceProduct->price_today}} </td>
								@else
								<td></td>
								@endif
								@if(isset($product->priceProduct) )
								<td>{{$product->priceProduct->price_yesterday}} </td>
								@else
								<td></td>
								@endif
								@if(isset($product->priceProduct) )
								<td>{{$product->priceProduct->price_before_yesterday}} </td>
								@else
								<td></td>
								@endif

													
							</tr>
							@endforeach

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