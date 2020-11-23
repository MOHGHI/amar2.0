@inject ('reviewHelper', 'App\Helpers\Review')
@php
    $percentageRatings = $reviewHelper->getPercentageRating($item->id,$item->feedbacks_count);
    $countRatings = $reviewHelper->getCountRating($item->id,$item->feedbacks_count);
@endphp
<div class="row big-rating-row">
	<div class="col-md-5 nopadding-right">

	<span class="score-average">{{$ratings}}</span><span class="total-rating">/5</span>

<div class="big-rating product-info-rating">
@if($ratings)
@for($i = 0; $i < 5; $i++)
@if( ($ratings - $i) >= 1 )
<span class="rated"><i class="fa fa-star fa-fw"></i></span>
@elseif( ($ratings - $i) < 1 && ($ratings - $i) > 0 )
<span class="rated"><i class="fa fa-star-half-o fa-fw"></i></span>
@else
<span><i class="fa fa-star-o fa-fw"></i></span>
@endif
@endfor
@endif
</div>

{{$ratings}} Ratings & {{$count}} Reviews
</div>
<div class="col-md-7 nopadding">
<style>
.customer-rating .rating-bar {
top: 12px;
padding: 0;
height: 5px;
position: relative;
background-color: #f7f7f9;
}

.customer-rating .rating-bar>div {
width: 0;
height: 100%;
background-color: #177b41;
}
</style>
<div class="col-lg-12 col-xl-6">
		@for ($i = 5; $i >= 1; $i--)
			<div class="row customer-rating">
				<ul>
					<li>
						<div class="container-star progress-title" style="width: 100px; height: auto">
						@for ($j = 1; $j <= $i; $j++)
							<img class="star" src="//laz-img-cdn.alicdn.com/tfs/TB19ZvEgfDH8KJjy1XcXXcpdXXa-64-64.png" style="width: 15.96px; height: 15.96px;">
						@endfor
						</div>
						<div class="col-7 rating-bar" title="{{ $percentageRatings[$i] }}%">
							<div style="width: {{ $percentageRatings[$i] }}%"></div>
						</div>
						<span class="col-2 fs16">{{ $countRatings[$i] }}</span>
					</li>
				</ul>
			</div>
		@endfor
	</div>
</div>
</div>
