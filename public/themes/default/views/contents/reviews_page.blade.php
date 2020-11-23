<section class="bg-white product-section space0">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-5 rating-wrapper nopadding-left">
			@include('layouts.ratingstable', ['ratings' => $item->feedbacks->avg('rating'), 'count' => $item->feedbacks_count])
			</div>
			<div class="col-md-7 rating-product-wrapper">
				<div class="product-inn">
					<div class="product-img-wrapper">
						<img class="product-img" src="{{ get_inventory_img_src($item, 'medium') }}" data-name="product_image" alt="{!! $item->title !!}" title="{!! $item->title !!}" />
					</div>
					<h3>
					<a class="product-link" href="{{ route('show.product', $item->slug) }}">{{$item->title}}</a>
					</h3>
				</div>
			</div>
		</div>
		<div class="row reviews-table">
			<div class="reviews-tab">
				@php 
					$items = $item->feedbacks->paginate(5)
				@endphp
				@forelse($items as $feedback)
				<p>
					<b>{{ $feedback->customer->getName() }}</b>
					<span class="pull-right small">
						<b class="text-success">@lang('theme.verified_purchase')</b>
						<span class="text-muted"> | {{ $feedback->created_at->diffForHumans() }}</span>
					</span>
				</p>
				<p>{{ $feedback->comment }}</p>
				@unless($loop->last)
				<div class="sep"></div>
				
				@endunless
				
				@empty
				<div class="space20"></div>
				<p class="lead text-center text-muted">@lang('theme.no_reviews')</p>
				@endforelse
				{{ $items->links('vendor.pagination.default') }}
			</div>
		</div>
	</div><!-- /.container -->
</section>

<div class="clearfix space20"></div>