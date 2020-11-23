<div class="row product-attribute-wrapper">
  <div class="col-md-12">
    <div class="boxs">
      <div class="boxs-header with-border">
          <h3 class="boxs-title">{{ isset($product) ? trans('app.update_product') : trans('app.add_product') }}</h3>
          <div class="boxs-tools pull-right">
            @if(!isset($product))
              <a href="javascript:void(0)" data-link="{{ route('admin.catalog.product.upload') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
            @endif
          </div>
      </div> <!-- /.box-header -->
    
      <div class="with-nav-tabs">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
            <li class="{{(isset($productTab) ? 'active' : '')}}"><a href="#details" data-toggle="tab">Product Details</a></li>
            @if(isset($product))
              <li class="{{(isset($varitionsTab) ? 'active' : '')}}"><a href="#variants" data-toggle="tab">Variants</a></li>
              <li class="{{(isset($inventoryTab) ? 'active' : '')}}"><a href="#inventory" data-toggle="tab">Inventory</a></li>
            @else
              <li class="disabled"><a href="#" data-toggle="tooltip" data-placement="top" title="Save the product first.">Variants</a></li>
              <li class="disabled"><a href="#" data-toggle="tooltip" data-placement="top" title="Save the product first.">Inventory</a></li>
            @endif
            
          </ul>
        </div>
        <div class="panel-body">
          <div class="tab-content">
            <div class="tab-pane fade {{(isset($productTab) ? 'in active' : '')}}" id="details">
              @if(isset($product))
                {!! Form::model($product, ['method' => 'POST', 'route' => ['admin.catalog.product.update', $product->id], 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
              @else
                {!! Form::open(['route' => 'admin.catalog.product.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
              @endif
                <div class="body">
                    <div class="row">
                          <div class="col-md-8">
                            <div class="box">
                              <div class="box-header with-border">
                                <h3 class="box-title">Product Details</h3>
                              </div>
                              <div class="box-body">
                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      {!! Form::label('category_list[]', trans('app.form.categories').'*') !!}
                                      {!! Form::select('category_list[]', $categories , Null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple', 'required']) !!}
                                      <div class="help-block with-errors"></div>
                                    </div>
                                  </div>
                                  <div class="col-md-10">
                                    <div class="form-group">
                                        {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_name') }}"></i>
                                        {!! Form::text('name', isset($product) ? $product->name : Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
                                        <div class="help-block with-errors"></div>
                                    </div>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="form-group">
                                        {!! Form::label('has_variant', trans('app.form.has_variant').'*', ['class' => 'with-help']) !!}
                                        <div class="input-group">
                                          {{ Form::hidden('has_variant', 0) }}
                                          {!! Form::checkbox('has_variant', null, !isset($product) ? 1 : null, ['id' => 'has_variant', 'class' => 'icheckbox_line']) !!}
                                          {!! Form::label('', '') !!}
                                          <span class="input-group-addon" id="basic-addon1">
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.has_variant') }}"></i>
                                          </span>
                                        </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                    <legend>Details</legend>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                      {!! Form::label('description', trans('app.form.description').'*', ['class' => 'with-help']) !!}
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_description') }}"></i>
                                      {!! Form::textarea('description', isset($product) ? $product->description : Null, ['class' => 'form-control summernote', 'rows' => '6', 'placeholder' => trans('app.placeholder.description'), 'required']) !!}
                                      <div class="help-block with-errors">{!! $errors->first('description', ':message') !!}</div>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                      <legend>
                                        {{ trans('app.featured_image') }}
                                        <i class="fa fa-question-circle small" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_featured_image') }}"></i>
                                      </legend>
                                      @if(isset($product) && $product->featuredImage)
                                        <img src="{{ get_storage_file_url($product->featuredImage->path, 'small') }}" alt="{{ trans('app.featured_image') }}">
                                        <label>
                                          <span style="margin-left: 10px;">
                                            {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!} {{ trans('app.form.delete_image') }}
                                          </span>
                                        </label>
                                      @endif
                                  </div>
                                  <div class="col-md-12">
                                      <div class="row">
                                          <div class="col-md-9 nopadding-right">
                                          <input id="uploadFile" placeholder="{{ trans('app.featured_image') }}" class="form-control" disabled="disabled" style="height: 28px;" />
                                          </div>
                                          <div class="col-md-3 nopadding-left">
                                            <div class="fileUpload btn btn-primary btn-block btn-flat">
                                                <span>{{ trans('app.form.upload') }} </span>
                                                <input type="file" name="image" id="uploadBtn" class="upload" />
                                            </div>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-12">
                                      <legend>
                                        {{ trans('app.form.images') }}
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_images') }}"></i>
                                      </legend>
                                      <div class="form-group">
                                        <div class="file-loading">
                                        <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
                                        </div>
                                      </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                      <div class="col-md-4">
                        <div class="box">
                          <div class="box-header with-border">
                            <h3 class="box-title">Product Details</h3>
                          </div>
                          <div class="box-body">
                            <div class="row">
                              <div class="col-md-6">
                                  <div class="form-group">
                                    {!! Form::label('brand', trans('app.form.brand'), ['class' => 'with-help']) !!}
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.brand') }}"></i>
                                    {!! Form::text('brand', isset($product) ? $product->brand : Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.brand')]) !!}
                                  </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="form-group">
                                      {!! Form::label('mpn', trans('app.form.mpn'), ['class' => 'with-help']) !!}
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.mpn') }}"></i>
                                      {!! Form::text('mpn', isset($product) ? $product->mpn : Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.mpn')]) !!}
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    {!! Form::label('model_number', trans('app.form.model_number'), ['class' => 'with-help']) !!}
                                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.model_number') }}"></i>
                                    {!! Form::text('model_number', isset($product) ? $product->model_number : Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.model_number')]) !!}
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    {!! Form::label('manufacturer_id', trans('app.form.manufacturer'), ['class' => 'with-help']) !!}
                                    {!! Form::select('manufacturer_id', $manufacturers , null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.manufacturer')]) !!}
                                    <div class="help-block with-errors"></div>
                                  </div>  
                              </div>
                            
                              <div class="col-md-12">
                                <legend>GTIN Information</legend>
                              </div>
                              <div class="col-md-6">
                                    <div class="form-group">
                                      {!! Form::label('gtin', trans('app.form.gtin'), ['class' => 'with-help']) !!}
                                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.gtin') }}"></i>
                                      {!! Form::text('gtin', isset($product) ? $product->gtin : Null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.gtin')]) !!}
                                    </div>
                              </div>
                              <div class="col-md-6">
                                    <div class="form-group">
                                      {!! Form::label('gtin_type', trans('app.form.gtin_type'), ['class' => 'with-help']) !!}
                                      {!! Form::select('gtin_type', $gtin_types , isset($product) ? $product->gtin_type : Null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.gtin_type')]) !!}
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                      {!! Form::label('origin_country', trans('app.form.origin'), ['class' => 'with-help']) !!}
                                      {!! Form::select('origin_country', $countries , isset($product) ? $product->country : Null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.origin')]) !!}
                                      <div class="help-block with-errors"></div>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                        {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
                                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.product_active') }}"></i>
                                        {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], !isset($product) ? 1 : null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'), 'required']) !!}
                                        <div class="help-block with-errors"></div>
                                      </div>
                              </div>
                              <div class="col-md-4">
                                      <div class="form-group">
                                        {!! Form::label('requires_shipping', trans('app.form.requires_shipping')) !!}
                                        <div class="input-group">
                                          {{ Form::hidden('requires_shipping', 0) }}
                                          {!! Form::checkbox('requires_shipping', null, !isset($product) ? 1 : null, ['id' => 'requires_shipping', 'class' => 'icheckbox_line']) !!}
                                          {!! Form::label('', '') !!}
                                          <span class="input-group-addon" id="basic-addon1">
                                            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.requires_shipping') }}"></i>
                                          </span>
                                        </div>
                                      </div>
                              </div>
                              <div class="col-md-8">
                                <div class="form-group">
                                  {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
                                  {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' => 'multiple']) !!}
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>    
                    </div>
                    
                    <div class="col-md-12">
                      <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
                      <div class="box-tools pull-right">
                        {!! Form::submit( isset($product) ? trans('app.form.update') : trans('app.form.save'), ['class' => 'btn btn-flat btn-lg btn-primary']) !!}
                      </div>
                    </div>
                    <div class="col-md-12">
                    {{-- <div class="form-group">
                            <div class="input-group">
                              {{ Form::hidden('downloadable', 0) }}
                              {!! Form::checkbox('downloadable', null, null, ['class' => 'icheckbox_line']) !!}
                              {!! Form::label('downloadable', trans('app.form.downloadable')) !!}
                              <span class="input-group-addon" id="basic-addon1">
                                <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left" title="{{ trans('help.downloadable') }}"></i>
                              </span>
                            </div>
                          </div> --}}

                          @if(auth()->user()->isFromplatform())
                            <div class="row">
                              <div class="col-md-6 nopadding-right">
                                <div class="form-group">
                                  {!! Form::label('min_price', trans('app.form.catalog_min_price'), ['class' => 'with-help']) !!}
                                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.catalog_min_price') }}"></i>
                                    <div class="input-group">
                                      <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                                      {!! Form::number('min_price' , null, ['class' => 'form-control', 'step' => 'any', 'min' => '0','placeholder' => trans('app.placeholder.catalog_min_price')]) !!}
                                    </div>
                                    <div class="help-block with-errors"></div>
                                </div>
                              </div>
                              <div class="col-md-6 nopadding-left">
                                <div class="form-group">
                                  {!! Form::label('max_price', trans('app.form.catalog_max_price'), ['class' => 'with-help']) !!}
                                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.catalog_max_price') }}"></i>
                                  <div class="input-group">
                                    <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                                    {!! Form::number('max_price' , null, ['class' => 'form-control', 'step' => 'any', 'min' => '0', 'placeholder' => trans('app.placeholder.catalog_max_price')]) !!}
                                  </div>
                                  <div class="help-block with-errors"></div>
                                </div>
                              </div>
                            </div>
                          @endif
                    </div>
                  </div>
                </div>
            {!! Form::close() !!}
            <div class="tab-pane fade {{(isset($varitionsTab) ? 'in active' : '')}}" id="variants">
            @if(isset($product))
              @if($product->has_variant)
              <div class="row">
                <div class="col-md-6 col-md-offset-3">
                  <div class="row">
                      {!! Form::open(['route' => ['admin.stock.inventory.addWithVariant', $product->id, 'new' => 1], 'method' => 'get', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
                      <div class="col-md-12">
                        {{ trans('app.form.set_variants') }}
                      </div>
                      @foreach($attributes as $attribute)
                        <div class="col-md-12">
                          <div class="form-group">
                                  {!! Form::label($attribute->name, $attribute->name, ['class' => 'with-help']) !!}
                                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.set_attribute') }}"></i>
                                  <select class="form-control select2-set_attribute" id="{{ $attribute->name }}" name="{{ $attribute->id }}[]" multiple='multiple' placeholder="{{ trans('app.placeholder.attribute_values') }}">
                                      @foreach($attribute->attributeValues as $attributeValue)
                                          <option value="{{ $attributeValue->id }}">{{ $attributeValue->value }}</option>
                                      @endforeach
                                  </select>
                          </div>
                        </div>
                      @endforeach  
                      <div class="col-md-12 text-right">
                          {!! Form::submit(trans('app.form.set_variants'), ['class' => 'btn btn-flat btn-success']) !!}
                      </div>
                      {!! Form::close() !!}
                  </div> <!-- / .modal-content -->
                </div>
              </div>
                  <a href="javascript:void(0)" data-link="{{ route('admin.stock.inventory.setVariant', [$product->id, 'page' => 'some']) }}" class="ajax-modal-btn btn bg-olive btn-flat hidden">Add Variants  </a>
              @endif
            @endif
            </div>
            <div class="tab-pane fade {{(isset($inventoryTab) ? 'in active' : '')}}" id="inventory">
              @if(isset($product))
                @if($product->has_variant)
                  {!! Form::open(['route' => 'admin.catalog.product.storeWithVariant', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
                    @php
                      $i = 0;
                    @endphp
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="product_title" value="{{$product->title}}">
                    {{ Form::hidden('product', $product) }}
                    <table class="table table-default">
                      <thead>
                        <tr>
                          <th>Sr#</th>
                          <th>Variant</th>
                          <th>Title</th>
                          <th>Image</th>
                          <th>SKU</th>
                          <th>Condition</th>
                          <th>Stock</th>
                          <th>Purchase Price</th>
                          <th>Price</th>
                          <th>Offer Price</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody style="zoom: 0.80;">
                        @if(isset($combinations))
                          @foreach($combinations as $combination)
                            <tr>
                              <td><div class="form-group">{{ $i + 1 }}</div></td>
                              <td>
                                  
                                  <input type="hidden" name="has_variant" value="1">
                                  <div class="form-group">
                                    @foreach($combination as $attrId => $attrValue)
                                      {{ Form::hidden('variants['. $i .']['. $attrId .']', key($attrValue)) }}
                                      <span class="badge badge-success">{{ $attributes[$attrId] .' : '. current($attrValue) }}</span>
                                      {!! Form::text('variantTitle['. $i .']', $product['name'].'-'.$attributes[$attrId] .' : '. current($attrValue)) !!}
                                      {{ ($attrValue !== end($combination))?'; ':'' }}
                                    @endforeach
                                  </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  <label class="img-btn-sm">
                                    {{ Form::file('image['. $i .']') }}
                                    <span>{{ trans('app.placeholder.image') }}</span>
                                  </label>
                                </div>
                              </td>
                              <td>
                                @php 
                                  $title_classes = isset($variants) ? 'form-control' : 'form-control makeSlug';
                                  $variantTitle = '';
                                @endphp
                                  <div class="form-group">
                                    {!! Form::label('title', trans('app.form.title').'*') !!}
                                    @foreach($combination as $attrId => $attrValue)
                                      <!-- <span class="badge badge-success">{{ $attributes[$attrId] .' : '. current($attrValue) }}</span> -->
                                      @php 
                                        
                                        $variantTitle .= $attributes[$attrId] .'-'. current($attrValue) ;
                                        $variantTitle .= ($attrValue !== end($combination)) ? '-' : '';
                                      @endphp
                                    @endforeach
                                    {!! Form::text('title['. $i .']', $product->name.'-'.$variantTitle, ['class' => $title_classes, 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
                                    
                                    <div class="help-block with-errors"></div>
                                  </div>
                                  <!-- <div class="form-group hidden">
                                    {!! Form::label('description', trans('app.form.title').'*') !!}
                                    {!! Form::text('description', 'SomeDescR', ['class' => $title_classes, 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
                                    <div class="help-block with-errors"></div>
                                  </div> -->
                              </td>
                              <td>
                                <div class="form-group">
                                  {!! Form::text('sku['. $i .']', null, ['class' => 'form-control sku', 'placeholder' => trans('app.placeholder.sku'), 'required']) !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  {!! Form::select('condition['. $i .']', ['New' => trans('app.new'), 'Used' => trans('app.used'), 'Refurbished' => trans('app.refurbished')], null, ['class' => 'form-control condition', 'required']) !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  {!! Form::number('stock_quantity['. $i .']', null, ['class' => 'form-control quantity', 'placeholder' => trans('app.placeholder.stock_quantity'), 'required']) !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  {!! Form::number('purchase_price['. $i .']', null, ['class' => 'form-control purchasePrice', 'step' => 'any', 'placeholder' => trans('app.placeholder.purchase_price')]) !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  {!! Form::number('sale_price['. $i .']', null, ['class' => 'form-control salePrice', 'step' => 'any', 'placeholder' => trans('app.placeholder.sale_price'), 'required']) !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group">
                                  {!! Form::number('offer_price['. $i .']', null, ['class' => 'form-control offerPrice', 'step' => 'any', 'placeholder' => trans('app.placeholder.offer_price')]) !!}
                                </div>
                              </td>
                              <td>
                                <div class="form-group text-muted">
                                  <i class="fa fa-close deleteThisRow" data-toggle="tooltip" data-placement="left" title="{{ trans('help.delete_this_combination') }}"></i>
                                </div>
                              </td>
                            </tr>
                            <?php $i++; ?>
                          @endforeach
                        @endif
                      </tbody>
                    </table>
                    <button class="btn btn-primary pull-right" type="submit">Save</button>
                  {!! Form::close() !!}
                @else
                  {!! Form::open(['route' => 'admin.stock.inventory.store', 'files' => true, 'id' => 'form-ajax-upload', 'data-toggle' => 'validator']) !!}
                    <input type="hidden" name="id" value="{{$product->id}}">
                    <input type="hidden" name="product_title" value="{{$product->title}}">  
                    <div class="row">
                      @php 
                      if(isset($inventory)){
                        $product = $inventory->product;
                      }
                      $requires_shipping = $product->requires_shipping || (isset($inventory) && $inventory->product->requires_shipping);
                      $title_classes = isset($variants) ? 'form-control' : 'form-control makeSlug';
                      @endphp
                      {{ Form::hidden('product_id', $product->id) }}
                      {{ Form::hidden('brand', $product->brand) }}
                      <input type="hidden" name="has_variant" value="0">
                      <div class="col-md-12">
                        <div class="form-group">
                          {!! Form::label('title', trans('app.form.title').'*') !!}
                          {!! Form::text('title', $product->title, ['class' => $title_classes, 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>

                      <div class="col-md-7 nopadding-right">
                        <div class="form-group">
                          {!! Form::label('sku', trans('app.form.sku').'*', ['class' => 'with-help']) !!}
                          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sku') }}"></i>
                          {!! Form::text('sku', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.sku'), 'required']) !!}
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>

                      <div class="col-md-3 nopadding">
                        <div class="form-group">
                          {!! Form::label('condition', trans('app.form.condition').'*', ['class' => 'with-help']) !!}
                          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_product_condition') }}"></i>
                          {!! Form::select('condition', ['New' => trans('app.new'), 'Used' => trans('app.used'), 'Refurbished' => trans('app.refurbished')], isset($inventory) ? null : 'New', ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>

                      <div class="col-md-2 nopadding-left">
                        <div class="form-group">
                          {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
                          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_inventory_status') }}"></i>
                          {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], isset($inventory) ? null : 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
                          <div class="help-block with-errors"></div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <fieldset>
                          <legend>{{ trans('app.inventory_rules') }}</legend>
                          @if($requires_shipping)
                            <div class="row">
                              <div class="col-md-3 nopadding-right">
                                <div class="form-group">
                                  {!! Form::label('stock_quantity', trans('app.form.stock_quantity').'*', ['class' => 'with-help']) !!}
                                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.stock_quantity') }}"></i>
                                  {!! Form::number('stock_quantity', isset($inventory) ? null : 1, ['min' => 0, 'class' => 'form-control', 'placeholder' => trans('app.placeholder.stock_quantity'), 'required']) !!}
                                  <div class="help-block with-errors"></div>
                                </div>
                              </div>

                              <div class="col-md-3 nopadding">
                                <div class="form-group">
                                  {!! Form::label('min_order_quantity', trans('app.form.min_order_quantity'), ['class' => 'with-help']) !!}
                                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.min_order_quantity') }}"></i>
                                  {!! Form::number('min_order_quantity', isset($inventory) ? null : 1, ['min' => 1, 'class' => 'form-control', 'placeholder' => trans('app.placeholder.min_order_quantity')]) !!}
                                </div>
                              </div>

                              <div class="col-md-3 nopadding">
                                <div class="form-group">
                                  {!! Form::label('purchase_price', trans('app.form.purchase_price'), ['class' => 'with-help']) !!}
                                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.purchase_price') }}"></i>
                                  <div class="input-group">
                                    <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                                    {!! Form::number('purchase_price', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.purchase_price')]) !!}
                                  </div>
                                </div>
                              </div>

                              <div class="col-md-3 nopadding-left">
                                <div class="form-group">
                                  {!! Form::label('sale_price', trans('app.form.sale_price').'*', ['class' => 'with-help']) !!}
                                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sale_price') }}"></i>
                                  <div class="input-group">
                                    <span class="input-group-addon">{{ config('system_settings.currency_symbol') ?: '$' }}</span>
                                    <input name="sale_price" value="{{ isset($inventory) ? $inventory->sale_price : Null }}" type="number" min="{{ $product->min_price }}" {{ $product->max_price ? ' max="'. $product->max_price .'"' : '' }} step="any" placeholder="{{ trans('app.placeholder.sale_price') }}" class="form-control" required="required">
                                  </div>
                                  <div class="help-block with-errors"></div>
                                </div>
                              </div>

                            </div>
                          @endif

                          
                        </fieldset>
                      </div>
                    </div>
                    <button class="btn btn-primary pull-right" type="submit">Save</button>
                  {!! Form::close() !!}
                @endif
              @endif
            </div>
          </div>
        </div>
      </div>
      
    </div>
  </div>
</div>
