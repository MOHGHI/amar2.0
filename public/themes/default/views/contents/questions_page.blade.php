<section class="bg-white product-section space0">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12 nopadding">
				{!! Form::open(['route' => array('show.product.questions', $item->slug), 'method' => 'GET']) !!}
					<div class="form-group search-questions">
						<input id="my-input" value="{{ $searching }}" placeholder="Search Questions" class="form-control pull-left" type="text" name="search">
						<button class="btn btn-primary pull-right" type="submit"><i class="fa fa-search"></i></button>
					</div>
				{!! Form::close() !!}
			</div>
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
				@forelse($questions as $feedback)
						<div class="qna-item-group">
                            <div class="row">
                                <div class="col-md-1 nopadding qna-label">
                                    <span class="question">Q</span>
                                </div>
                                <div class="col-md-11">
									<div class="qna-content">
										{{$feedback->message}}
										<span class="text-muted pull-right">{{ $feedback->created_at->diffForHumans() }}</span>
									</div>
									<div class="qna-meta">{{$feedback->customer->getName()}}</div>
								</div>
                            </div>    
                            <div class="row">
                                <div class="col-md-1 nopadding qna-label">
                                    <span class="answer">A</span>
                                </div>
                                <div class="col-md-11">
                                    <div class="qna-content">Not Answered Yet</div>
                                </div>
                            </div>
                        </div>
				@unless($loop->last)
				<div class="sep"></div>
				@endunless
				@empty
				<div class="space20"></div>
				<p class="lead text-center text-muted">@lang('theme.no_reviews')</p>
				@endforelse
				{{ $questions->links('vendor.pagination.default') }}
			</div>
		</div>
	</div><!-- /.container -->
</section>

<div class="clearfix space20"></div>