<section class="store-banner-img-wrapper">
	<div class="banner banner-o-hid" style="background-color: #333; background-image:url( {{ get_cover_img_src($shop, 'shop') }} );">
		<div class="banner-caption">
			<img src="{{ get_storage_file_url(optional($shop->logo)->path, 'thumbnail') }}" class="img-rounded">
			<h5 class="banner-title">
                <a href="#">
	            	{!! $shop->getQualifiedName() !!}
                </a>
			</h5>
            <span class="small">
	            @include('layouts.ratings', ['ratings' => $shop->feedbacks->avg('rating'), 'count' => $shop->feedbacks->count(),'shop' => true])
	        </span>
			<p class="member-since small">{{ trans('theme.member_since') }}: {{ $shop->created_at->diffForHumans() }}</p>
			<p class="member-since small">{{ trans('theme.items_sold') }}: {{ \App\Helpers\Statistics::sold_items_count($shop->id) }}</p>
			<p class="member-since small"><a href="{{ route('reviews.store', $shop->slug) }}">Shop Policy</a></p>
		</div>
	</div>
</section>