<div id="carousel-pager " class="carousel slide hidden" data-ride="carousel" data-interval="500000000">
	<!-- Carousel items -->
	<div class="carousel-inner vertical">
		@php
			$item_images = $item->images->count() ? $item->images : $item->product->images;

			if(isset($variants)){
				// Remove images of current items from the variants imgs
				$other_images = $variants->pluck('images')->flatten(1)->filter(function ($value, $key) use ($item) {
									return $value->imageable_id != $item->id;
								});
				$item_images = $item_images->concat($other_images);
			}
		@endphp
		@foreach($item_images as $img)
			<div class="active item">
				<a class="{{ $img->path == optional($item->image)->path ? 'zoomThumbActive' : '' }}" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '{{ get_storage_file_url($img->path, 'large') }}', largeimage: '{{ get_storage_file_url($img->path, 'full') }}'}">
					<img src="{{ get_storage_file_url($img->path, 'mini') }}" alt="Thumb" title="{{ $item->title }}" />
				</a>
			</div>
		@endforeach
		
	</div>

	<!-- Controls -->
	<a class="left carousel-control" href="#carousel-pager" role="button" data-slide="prev">
		<span class="fa fa-chevron-up" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="right carousel-control" href="#carousel-pager" role="button" data-slide="next">
		<span class="fa fa-chevron-down" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>
</div>
<div id="carousel-pager" class="carousel slide" data-ride="carousel" data-interval="500000000">
<div class="carousel-inner vertical">
	<ul class="jqzoom-thumbs">
		<a href="#" style="opacity: 0.8; width: 56%;right: 4%; position: absolute; top: 0; background: white;" class="btn btn-link go-up-thumbnail">
			<i class="fa fa-chevron-up"></i>
		</a>
		@php
			$item_images = $item->images->count() ? $item->images : $item->product->images;

			if(isset($variants)){
				// Remove images of current items from the variants imgs
				$other_images = $variants->pluck('images')->flatten(1)->filter(function ($value, $key) use ($item) {
									return $value->imageable_id != $item->id;
								});
				$item_images = $item_images->concat($other_images);
			}
		@endphp
		@foreach($item_images as $img)
			<li>
				<a class="{{ $img->path == optional($item->image)->path ? 'zoomThumbActive' : '' }}" href="javascript:void(0)" data-rel="{gallery:'gal-1', smallimage: '{{ get_storage_file_url($img->path, 'large') }}', largeimage: '{{ get_storage_file_url($img->path, 'full') }}'}">
					<img class="image-res" src="{{ get_storage_file_url($img->path, 'mini') }}" alt="Thumb" title="{{ $item->title }}" />
				</a>
			</li>
		@endforeach
		<a href="#" style="opacity: 0.8; width: 56%;right: 4%; position: absolute; bottom: 0; background: white;" class="btn btn-link go-down-thumbnail">
			<i class="fa fa-chevron-down"></i>
		</a>
	</ul> <!-- /.jqzoom-thumbs -->
	
</div>
</div>