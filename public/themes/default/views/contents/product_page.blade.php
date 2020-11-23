@php	
	$shipping_country = $business_areas->where('iso_code', $geoip->iso_code)->first();
	$shipping_state = \DB::table('states')->select('id', 'name', 'iso_code')->where([
		['country_id', '=', $shipping_country->id], ['iso_code', '=', $geoip->state]
	])->first();

	$shipping_zone = get_shipping_zone_of($item->shop_id, $shipping_country->id, optional($shipping_state)->id);
	$shipping_options = isset($shipping_zone->id) ? getShippingRates($shipping_zone->id) : 'NaN';
@endphp

<section class="bg-white product-section space0">
	<div class="container-fluid">
		<div class="row sc-product-item" id="single-product-wrapper">
		  	<div class="col-md-1 nopadding pro-thumb">
		  		@include('layouts.jqzoom_thumbnail', ['item' => $item, 'variants' => $variants])
		  	</div><!-- /.col-md-5 col-sm-6 -->
		  	<div class="col-md-4 col-sm-12 nopadding-left">
		  		@include('layouts.jqzoom', ['item' => $item, 'variants' => $variants])
			</div><!-- /.col-md-5 col-sm-6 -->
				
		  	<div class="col-md-7 col-sm-12">
		  		<div class="row">
				  	<div class="col-md-7 col-sm-6 nopadding">
				      	<div class="product-single">
					  		@include('layouts.product_info', ['item' => $item])

			              	<div class="space20"></div>

			              	@if($item->key_features)
							<div class="">
								<div class="section-title hidden">
									<h4>{!! trans('theme.section_headings.key_features') !!}</h4>
								</div>
								<ul class="key_feature_list">
									@foreach(unserialize($item->key_features) as $key_feature)
									<li>{!! $key_feature !!}</li>
									@endforeach
								</ul>
							</div>
							@endif

							@if($item->product->inventories_count > 1)
							<a href="{{ route('show.offers', $item->product->slug) }}" class="btn btn-sm btn-link">
								@lang('theme.view_more_offers', ['count' => $item->product->inventories_count])
							</a>
							@endif

						<!-- /.product-option -->
 				          	
				      	</div><!-- /.product-single -->
			  		</div>

				  	<div class="col-md-5 col-sm-12 right-wrapper nopadding">
				        <div class="right-info-wrapper">
				        	<div class="product-price-right space10">
								@include('layouts.pricing', ['item' => $item])
							</div>
							<div class="space10 product-stock hidden">
								<span class="available-qty-count">@lang('theme.stock_count', ['count' =>
									$item->stock_quantity])</span>
							</div>

				            <div class="product-info-options space10">
				            	<div class="sep"></div>


				            	<div id="calculation-section">
									<div class="row">
										<div class="col-sm-12 col-xs-4 space10 nopadding-left">
											<span class="info-label" data-options="{{ $shipping_options }}" id="shipping-options" >@lang('theme.shipping'):</span>
								            {{ Form::hidden('shipping_zone_id', isset($shipping_zone->id) ? $shipping_zone->id : Null, ['id' => 'shipping-zone-id']) }}
								            {{ Form::hidden('shipping_rate_id', 10, ['id' => 'shipping-rate-id']) }}
								            {{ Form::hidden('shipto_country_id', $shipping_country->id, ['id' => 'shipto-country-id']) }}
											{{ Form::hidden('shipto_state_id', optional($shipping_state)->id, ['id' => 'shipto-state-id']) }}
											<div id="summary-shipping-cost" class="pull-right"></div>
										</div>
										<div class="col-sm-12 col-xs-8 space20 nopadding-left">
											
											<div id="product-info-shipping-detail">
												<span>{{ strtolower(trans('theme.to')) }}
													<a id="shipTo" class="ship_to" data-country="{{$shipping_country->id}}" data-state="{{optional($shipping_state)->id}}" href="javascript:void(0)">
					                            		{{ $shipping_state ? $shipping_state->name : $geoip->country }}
					                            	</a>

													<select id="width_tmp_select"><option id="width_tmp_option"></option></select>
												</span>
												<br>
												<span class="dynamic-shipping-rates" data-toggle="popover" title="{{ trans('theme.shipping_options') }}">
						                            <span id="summary-shipping-carrier"></span>
						                            <small><i class="fa fa-caret-square-o-down"></i></small>
										  		</span>
											</div>
											<small class="text-muted" id="delivery-time"></small>
										</div><!-- /.col-sm-9 .col-xs-6 -->
									</div><!-- /.row -->

									<div class="row quantity-wrapper-4 space20 ">
										<div class="col-sm-12 col-xs-12 col-md-12 nopadding-left">
											<span class="info-label qtt-label">@lang('theme.quantity')</span>
										</div>
										<div class="col-sm-12 col-xs-12 col-md-12 nopadding-left">
											<div class="product-qty-wrapper">
												<div class="product-info-qty-item">
													<button class="product-info-qty product-info-qty-minus">-</button>
													<input class="product-info-qty product-info-qty-input"
														data-name="product_quantity"
														data-min="{{$item->min_order_quantity}}"
														data-max="{{$item->stock_quantity}}" type="text"
														value="{{$item->min_order_quantity}}">
													<button class="product-info-qty product-info-qty-plus">+</button>
												</div>
												<span class="available-qty-count">@lang('theme.stock_count', ['count' =>
													$item->stock_quantity])</span>
												<!-- Stock quantity -->
											</div>
										</div><!-- /.col-sm-9 .col-xs-6 -->
									</div><!-- /.row -->

									<div class="row" id="order-total-row">
										<div class="col-sm-3 col-xs-4 nopadding-left">
											<span class="info-label">@lang('theme.total'):</span>
										</div>
										<div class="col-sm-9 col-xs-8 nopadding">
											<span id="summary-total" class="text-muted">{{ trans('theme.notify.will_calculated_on_select') }}</span>
										</div><!-- /.col-sm-9 .col-xs-6 -->
									</div><!-- /.row -->
								</div>

							@auth('customer')
							<a data-link="{{ route('cart.addItem', $item->slug) }}"
								class="btn btn-primary btn-lg btn-block flat space10 sc-add-to-cart">
								<i class="fa fa-shopping-bag"></i> @lang('theme.button.add_to_cart')
							</a>
							@else
							<button data-link="javascript:void(0);" type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-primary btn-lg btn-block flat space10 sc-add-to-cart1" id="checkout-btn" ><i class="fa fa-shopping-bag"></i> @lang('theme.button.add_to_cart')</button>
							@endauth

							@auth('customer')
							<a href="{{ route('direct.checkout', $item->slug) }}"
								class="btn btn-lg btn-primary flat btn-buy-now" id="buy-now-btn"><i
									class="fa fa-rocket"></i> @lang('theme.button.buy_now')</a>
							@else
							<button href="{{ route('direct.checkout', $item->slug) }}"  type="button" data-toggle="modal" data-target="#loginModal" class="btn btn-lg btn-primary flat btn-buy-now" id="buy-now-btn" ><i class="fa fa-rocket"></i> @lang('theme.button.buy_now')</button>
							@endauth

							@if($item->product->inventories_count > 1)
							<a href="{{ route('show.offers', $item->product->slug) }}"
								class="btn btn-block btn-link btn-sm">
								@lang('theme.view_more_offers', ['count' => $item->product->inventories_count])
							</a>
							@endif

							<div class="clearfix space20"></div>
							<div class="seller-info space0">
								<div class="text-muted small">@lang('theme.sold_by')</div>

								<img src="{{ get_storage_file_url(optional($item->shop->image)->path, 'tiny') }}"
									class="seller-info-logo img-sm img-circle" alt="{{ trans('theme.logo') }}">

								<a href="{{ route('show.store', $item->shop->slug) }}" class="seller-info-name">
									{!! $item->shop->getQualifiedName() !!}
								</a>
							</div>
							<div class="row">
								<div class="col-sm-12 border-right nopadding">
									<div class="description-block">
										<span class="description-text small">
												@include('layouts.ppageratings', ['ratings' => $shop->feedbacks->avg('rating'), 'count' => $shop->feedbacks->count()])
										</span>
									</div>
								</div>
							</div>

							<div class="row shop-stats">
									<div class="col-sm-6 col-xs-6 border-right ">
										<div class="product-info-condition space10">
											<h5 class="description-header">{{ $shop->inventories_count }}</h5>
											<span class="description-text">{{ trans('theme.active_listings') }}</span>
										</div>
									</div>
									<div class="col-sm-6 col-xs-6">
											<div class="product-info-condition space10">
											<h5 class="description-header">{{ \App\Helpers\Statistics::sold_items_count($shop->id) }}</h5>
											<span class="description-text">{{ trans('theme.items_sold') }}</span>
										</div>
									</div>
							</div>
				            	
				            </div>

							
				        </div><!-- /.seller-info -->

			          	
			  		</div>
		  		</div><!-- /.row -->
		      	<div class="space20"></div>
		  	</div><!-- /.col-md-7 col-sm-6 -->
		</div><!-- /.row -->
	</div><!-- /.container -->
</section>

<section id="bg-white item-desc-section " style="background:white; padding: 30px 20px;">
	<div class="container">
		{!! $item->product->description !!}
	</div>
	@if($linked_items->count())
				<div class="div col-md-12 linked-items-section space30">
					<div class="section-title">
						<h4>@lang('theme.section_headings.bought_together') </h4>
					</div>
					@include('sliders.carousel_with_feedback', ['products' => $linked_items])
				</div>
			@endif
</section>

<section class="bg-white feedback-section">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<h4>{{ trans('theme.technical_details') }}: </h4>
				<table class="table table-striped noborder">
					<tbody>
						@if($item->product->brand)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.brand') }}: </th>
							<td class="noborder" style="width: 45%;">{{ $item->product->brand }}</td>
						</tr>
						@endif

						@if($item->product->model_number)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.model_number') }}:</th>
							<td class="noborder" style="width: 45%;">{{ $item->product->model_number }}</td>
						</tr>
						@endif

						@if($item->product->gtin_type && $item->product->gtin )
						<tr class="noborder">
							<th class="text-left noborder">{{ $item->product->gtin_type }}: </th>
							<td class="noborder" style="width: 45%;">{{ $item->product->gtin }}</td>
						</tr>
						@endif

						@if($item->product->mpn)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.mpn') }}: </th>
							<td class="noborder" style="width: 45%;">{{ $item->product->mpn }}</td>
						</tr>
						@endif

						@if($item->sku)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.sku') }}: </th>
							<td class="noborder" style="width: 45%;">{{ $item->sku }}</td>
						</tr>
						@endif

						@if($item->product->manufacturer)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.manufacturer') }}: </th>
							<td class="noborder" style="width: 45%;">{{ $item->product->manufacturer->name }}</td>
						</tr>
						@endif

						@if($item->product->origin)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.origin') }}: </th>
							<td class="noborder" style="width: 45%;">{{ $item->product->origin->name }}</td>
						</tr>
						@endif

						@if($item->min_order_quantity)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.min_order_quantity') }}: </th>
							<td class="noborder" style="width: 45%;">{{ $item->min_order_quantity }}</td>
						</tr>
						@endif

						@if($item->shipping_weight)
						<tr class="noborder">
							<th class="text-left noborder">{{ trans('theme.shipping_weight') }}: </th>
							<td class="noborder" style="width: 45%;">
								{{ $item->shipping_weight . ' ' . config('system_settings.weight_unit') }}</td>
						</tr>
						@endif

						<tr class="noborder">
							<th class="text-left noborder">
								{{ trans('theme.first_listed_on', ['platform' => get_platform_title()]) }}:</th>
							<td class="noborder" style="width: 45%;">
								{{ $item->product->created_at->toFormattedDateString() }}</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-6">
				@if($item->shop->config->return_refund)
				<h4>{{ trans('theme.return_and_refund_policy') }}: </h4>
				{!! $item->shop->config->return_refund !!}
				@endif
			</div>
		</div>
		<div class="row reviews-n-questions">
			<div class="col-md-6">
				<h3>Customer reviews</h3>
				@include('layouts.ratingstable', ['ratings' => $item->feedbacks->avg('rating'), 'count' => $item->feedbacks_count])
				<div class="product-page-reviews">
					<div class="reviews-tab ">
						@forelse($item->feedbacks->sortByDesc('created_at')->paginate(5) as $feedback)
						<p>
							<b>{{ $feedback->customer->getName() }}</b>

							<span class="pull-right small">
								<b class="text-success">@lang('theme.verified_purchase')</b>
								<span class="text-muted"> | {{ $feedback->created_at->diffForHumans() }}</span>
							</span>
						</p>

						<p>{{ $feedback->comment }}</p>

						@include('layouts.ratings', ['ratings' => $feedback->rating])

						@unless($loop->last)
						<div class="sep"></div>
						
						@endunless
						<div class="space30"></div>
						
						@empty
						<div class="space20"></div>
						<p class="lead text-center text-muted">@lang('theme.no_reviews')</p>
						@endforelse
						<a class="btn btn-secondary" href="{{ route('show.product.reviews', $item->slug) }}">All Reviews</a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<h3>Questions</h3>
				@include('contents.questions', ['item', $item])
				<a class="btn btn-secondary" href="{{ route('show.product.questions', $item->slug) }}">All Questions</a>
			</div>
			
		</div>

	</div>
</section>


<div class="clearfix space20"></div>