@extends('admin.layouts.master')

@section('content')
	@include('admin.product.add_existing')
@endsection

@section('page-script')
	@include('plugins.dropzone-upload')
@endsection