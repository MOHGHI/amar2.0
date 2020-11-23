@extends('admin.layouts.master')

@section('content')
	@if(isset($new) && $new == 0)
		@include('admin.product.search_catalog')
	@endif
	@elseif(isset($new) && $new == 1)
		{!! Form::open(['route' => 'admin.catalog.product.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
			@include('admin.product._form')
		{!! Form::close() !!}
	@else
		{!! Form::open(['route' => 'admin.catalog.product.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
			@include('admin.product._form')
		{!! Form::close() !!}
	@endif
@endsection

@section('page-script')
	@include('plugins.dropzone-upload')
	<script language="javascript" type="text/javascript">
		
	</script>
@endsection