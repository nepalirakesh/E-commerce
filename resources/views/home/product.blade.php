@extends('layouts.frontend.master')
@section('content')
<!-- SECTION -->
<div class="section">
	<!-- container -->
	<div class="container">
		<!-- row -->
		<div class="row">
			<!-- Product main img -->
			<div class="col-md-5 col-md-push-2">
				<div id="product-main-img">
					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->image) }}
						alt="">
					</div>

					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->photo->front_image) }}
						alt="">
					</div>

					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->photo->side_image) }}
						alt="">
					</div>

					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->photo->back_image) }}
						alt="">
					</div>
				</div>
			</div>
			<!-- /Product main img -->

			<!-- Product thumb imgs -->
			<div class="col-md-2  col-md-pull-5">
				<div id="product-imgs">
					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->image) }}
						alt="">
					</div>

					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->photo->front_image) }}
						alt="">
					</div>

					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->photo->side_image) }}
						alt="">
					</div>

					<div class="product-preview">
						<img src={{ asset("storage/images/".$product->photo->back_image) }}
						alt="">
					</div>
				</div>
			</div>
			<!-- /Product thumb imgs -->

			<!-- Product details -->
			<livewire:product-details :product='$product' />
			<!-- /Product details -->

			<!-- Product tab -->
			<div class="col-md-12">
				<div id="product-tab">
					<!-- product tab nav -->
					<ul class="tab-nav">
						<li class="active"><a data-toggle="tab" href="#tab1">Description</a></li>
						<li><a data-toggle="tab" href="#tab2">Specifications</a></li>
					</ul>
					<!-- /product tab nav -->

					<!-- product tab content -->
					<div class="tab-content">
						<!-- tab1  -->
						<div id="tab1" class="tab-pane fade in active">
							<div class="row">
								<div class="col-md-12">
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
										tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
										veniam,
										quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
										consequat. Duis aute irure dolor in reprehenderit in voluptate velit
										esse
										cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat
										cupidatat
										non proident, sunt in culpa qui officia deserunt mollit anim id est
										laborum.
									</p>
								</div>
							</div>
						</div>
						<!-- /tab1  -->

						<!-- tab2  -->
						<div id="tab2" class="tab-pane fade in">
							<div class="row">
								<div class="col-md-12">
									@if(count($product->specification)>0)
									@foreach ($product->specification as $spec)
									<p><b>{{ $spec->specification }} : </b>{{ $spec->value }}</p>
									@endforeach
									@else
									<center>
										<h4>No Specification Available</h4>
									</center>
									@endif
								</div>
							</div>
						</div>
						<!-- /tab2  -->

					</div>
					<!-- /product tab content  -->
				</div>
			</div>
			<!-- /product tab -->
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->
</div>
<!-- /SECTION -->

@endsection