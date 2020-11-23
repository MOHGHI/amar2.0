@extends('admin.layouts.master')

@section('content')
    
	    @include('admin.product._form')

    
@endsection

@section('page-script')
	@include('plugins.dropzone-upload')
@endsection