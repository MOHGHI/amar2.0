<section class="catlog-search-wrapper" style="background-size: cover;background-image: url({{ get_storage_file_url('bgpat.png', 'full') }})" >
    <div class="container">
        <div class="catlog-search">
        <img src="{{ get_storage_file_url('logo.png', 'full') }}" class="brand-logo" alt="{{ trans('app.logo') }}" title="{{ trans('app.logo') }}">
            <h1>Find your product in Amar's catlogue</h1>
            {!! Form::open(['route' => 'admin.catalog.product.result', 'files' => true, 'id' => '', 'type' => 'post', 'data-toggle' => 'validator']) !!}
                <input type="text" name="asin" class="form-control search-slt" placeholder="Enter Procuct AIN">        
                <button type="submit" class="btn btn-danger wrn-btn">Search</button>            
            {!! Form::close() !!}
            <h3 class="text-center"><a href="{{ route('admin.catalog.product.create') }}?new=1">I want to sale a product that isn't sold on Amar</a></h3>
        </div>
    </div>
</section>