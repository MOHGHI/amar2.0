<div class="row product-attribute-wrapper">
  <div class="col-md-10 col-md-offset-1">
    <div class="box">
      <div class="box-header with-border">
          <h3 class="box-title">Sell this product</h3>
      </div> <!-- /.box-header -->
    
      <div class="panel with-nav-tabs panel-default">
        <div class="panel-heading">
          <ul class="nav nav-tabs">
            <li class="active"><a href="#tab1default" data-toggle="tab">Product Details</a></li>
            <li><a href="#tab2default" data-toggle="tab">Inventory Management</a></li>
          </ul>
        </div>
        <div class="panel-body">
          {!! Form::open(['route' => 'admin.catalog.product.storeWithVariant', 'files' => true, 'id' => 'form', 'data-toggle' => 'validator']) !!}
            <div class="tab-content">
              <!-- Product Info -->
              <div class="tab-pane fade in active" id="tab1default">
                <div class="body">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <input type="hidden" name="has_variant" value="{{$product->has_variant}}">
                        <input type="hidden" name="product_id" value="{{$product->id}}">
                        {!! Form::label('title', trans('app.form.title').'*') !!}
                        {!! Form::text('title', $product->name, ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
                        <div class="help-block with-errors"></div>
                      </div>
                    </div>
                  </div>
                  <div class="spacer30"></div>

                  @include('admin.inventory._common_sell')
                  <div class="row hidden">
                      <div class="col-md-12 category-sell">
                        <label>Category</label>
                        
                      </div>
                      <div class="col-md-12 detail-sell">
                        <label>Product Name</label>
                        <h2 class="spacer0">{{$product->name}}</h2>
                      </div>
                  </div>
                  
                </div>

              </div>
              <!-- Product Inventory -->
              <div class="tab-pane fade" id="tab2default">
              
                @if($product->has_variant)
                  @php
                    $i = 0;
                  @endphp
                  
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Sr#</th>
                        <th width="20%">Variant</th>
                        <th>Image</th>
                        <th>SKU</th>
                        <th>Condition</th>
                        <th>Stock</th>
                        <th>Price</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($combinations as $combination)
                        
                          <tr>
                            <td><div class="form-group">{{ $i + 1 }}</div></td>
                            <?php //print_r($combination) ?>
                            <td>
                              
                              <div class="form-group">
                                    @foreach($combination as $attrId => $attrValue)
                                      {{ Form::hidden('variants['. $i .']['. $attrId .']', key($attrValue)) }}
                                      <span class="badge badge-success">{{ $attributes[$attrId] .' : '. current($attrValue) }}</span>
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
                                {!! Form::number('sale_price['. $i .']', null, ['class' => 'form-control salePrice', 'step' => 'any', 'placeholder' => trans('app.placeholder.sale_price'), 'required']) !!}
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
                    </tbody>
                  </table>
                @else
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
                    <div class="col-md-12">
                      <div class="form-group">
                        {!! Form::label('title', trans('app.form.title').'*') !!}
                        {!! Form::text('title', null, ['class' => $title_classes, 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
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
                @endif
                <button class="btn btn-primary" type="submit">Add to my shop</button>
              
              </div>
            </div>
          {!! Form::close() !!}
        </div>
      </div>

    </div>
  </div>
</div>