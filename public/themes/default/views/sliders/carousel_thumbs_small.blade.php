<div class="owl-carousel small-carousel carousel-img-only">
    @foreach($products as $item)
        <div class="product-widget">
            <img class="product-img" src="{{ get_inventory_img_src($item, 'small') }}" alt="{!! $item->title !!}" title="{!! $item->title !!}" />
            <a class="product-link itemQuickViews" data-href="{{ route('quickView.product', $item->slug) }}" href="{{ route('show.product', $item->slug) }}"></a>
        </div>
    @endforeach
</div>