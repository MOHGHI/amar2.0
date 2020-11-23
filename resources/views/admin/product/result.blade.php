@extends('admin.layouts.master')

@section('content')
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 result-search">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="catlog-search">
							<h3>Find your product in Amar's catlogue</h3>
							{!! Form::open(['route' => 'admin.catalog.product.result', 'files' => true, 'id' => '', 'type' => 'post', 'data-toggle' => 'validator']) !!}
								<input type="text" value="{{ (isset($product['gtin']) ? $product['gtin']: '') }}" name="asin" class="form-control search-slt" placeholder="Enter Procuct ASIN">        
								<button type="submit" class="btn btn-danger wrn-btn">Search</button>            
							{!! Form::close() !!}
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-12 result-product-wrapper">
				<div class="row">
					<div class="col-md-2 category-wrapper">
						<h4>Filter by category</h4>
						<br>
						<h4>All Categories</h4>
						<br>
						<p class="lead">Can't find your product in the Amar catalouge?</p>
						<a href="{{ route('admin.catalog.product.create') }}?new=1" class="btn btn-primary btn-muted">Create a new listing</a>
					</div>
					<div class="col-md-10 nopadding">
							<div class="product-wrapper">
								<div class="card-header">
									<h4>Displaying</h4>
								</div>
								<div class="card-body">
									<table class="table result-table">
										<tbody>
											@if($product != null)
											<tr>
												<td width="10%">
												<img src="{{ get_storage_file_url($product['featuredImage']['path'], 'small') }}" alt="{{ trans('app.featured_image') }}">
												</td>
												<td width="40%">
													<h4>
														<strong>{{$product['name']}}</strong>
													</h4>
												</td>
												<td width="15%">
													<h4><strong>EAN:</strong> {{$product['gtin']}}</h4>
												</td>
												<td width="20%">
													<h5 class="text-center"><strong>Sales rank: 135,55</strong></h5>
													<h5 class="text-center"><strong>Offers:</strong> 1 Used & New</h5>
												</td>
												<td width="15%">
													<div class="action-wrapper text-center">
														@if($product['has_variant'])
															{!! Form::open(['route' => 'admin.catalog.product.sell', 'files' => true, 'id' => '', 'type' => 'post', 'data-toggle' => 'validator']) !!}
																<input type="hidden" name="id" value="{{$product['id']}}" >
																<button class="btn btn-primary" type="submit">Sell this product</button>
															{!! Form::close() !!}
														@else
															<a class="btn btn-primary" href="{{route('admin.stock.inventory.add', $product['id'])}}">Sell this product</a>
														@endif
														<h5><a href="#" class="">Show Limitations</a></h5>
													</div>
												</td>
											</tr>
											@else
											<tr>
												<td>No Product found</td>
											</tr>
											@endif
										</tbody>
									</table>
								</div>
								<div class="card-footer">
									Page 1
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

@section('page-script')
	@include('plugins.dropzone-upload')
@endsection