@extends('layouts.main')

@section('content')
    <!-- HEADER SECTION -->
    @include('headers.order_detail')

    <!-- CONTENT SECTION -->
	@include('contents.order_detail')

    <!-- BROWSING ITEMS -->
    @include('sliders.browsing_items')
@endsection