{{-- @if(isset($product))
  {{ Form::hidden('product_id', $product->id) }}
@elseif($inventory)
  {{ Form::hidden('product_id', $inventory->product_id) }}
@endif
 --}}
 

{{ Form::hidden('product', $product) }}
<div class="col-md-8">  
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">
        {{ trans('app.add_inventory') }}
      </h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div> <!-- /.box-header -->
      <div class="box-body">
            <div class="row hidden">
              <div class="col-md-12">
                <div class="form-group">
                  {!! Form::label('title', trans('app.form.title').'*') !!}
                  {!! Form::text('title', $product['name'], ['class' => 'form-control makeSlug', 'placeholder' => trans('app.placeholder.title'), 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>
            </div>
            @if(isset($inventory))
              @php
              $title = $product['name'];
              $description = $product['description'];
              $productId = $product['id'];
                $product = $product;
              @endphp
            @endif
            
            <fieldset>
              <legend class="text-left">{{ trans('app.variants') }}</legend>
              <table class="table table-default" id="variantsTable">
                <thead>
                  <tr>
                    <th>{{ trans('app.sl_number') }}</th>
                    <th>{{ trans('app.form.variants') }}
                      <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ trans('help.variants') }}"><sup><i class="fa fa-question"></i></sup></small>
                    </th>
                    <th>{{ trans('app.form.image') }}
                      <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ trans('help.variant_image') }}"><sup><i class="fa fa-question"></i></sup></small>
                    </th>
                    <th>{{ trans('app.form.sku') }}
                      <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sku') }}"><sup><i class="fa fa-question"></i></sup></small>
                    </th>
                    <th>{{ trans('app.form.condition') }}
                      <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_product_condition') }}"><sup><i class="fa fa-question"></i></sup></small>
                    </th>
                    <th>{{ trans('app.form.stock_quantity') }}
                      <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ trans('help.stock_quantity') }}"><sup><i class="fa fa-question"></i></sup></small>
                    </th>
                    
                    <th>{{ trans('app.form.sale_price') }}
                      <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ trans('help.sale_price') }}"><sup><i class="fa fa-question"></i></sup></small>
                    </th>
                    <th>{{ trans('app.form.offer_price') }}
                      <small class="text-muted" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_price') }}"><sup><i class="fa fa-question"></i></sup></small>
                    </th>
                    <th><i class="fa fa-trash-o"></i></th>
                  </tr>
                </thead>
                <tbody style="zoom: 0.80;">
                  @php
                    $i = 0;
                  @endphp
                  @foreach($combinations as $combination)
                    <tr>
                      <td><div class="form-group">{{ $i + 1 }}</div></td>
                      <td>
                        <div class="form-group">
                        @foreach($combination as $attrId => $attrValue)
                          {{ Form::hidden('variants['. $i .']['. $attrId .']', key($attrValue)) }}
                          {{ $attributes[$attrId] .' : '. current($attrValue) }}
                          {!! Form::hidden('variantTitle['. $i .']', $title.'-'. current($attrValue)) !!}
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
                  <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                      <div class="form-group text-muted">
                        <a href="javascript:void(0)" data-link="{{ route('admin.stock.inventory.setVariant', [$productId, 'page' => 'some']) }}" class="ajax-modal-btn btn bg-olive btn-flat">
                          <i class="fa fa-plus addNewVariant" ></i>
                        </a>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </fieldset>
            <!-- Offer Dates Starts -->
            <fieldset id="offerDates" hidden>
              <legend>{{ trans('app.offer_dates') }}</legend>
              <div class="row">
                <div class="col-lg-3 col-md-6 nopadding-right">
                  <div class="form-group">
                    {!! Form::label('offer_start', trans('app.form.offer_start'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_start') }}"></i>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      {!! Form::text('offer_start', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.offer_start')]) !!}
                    </div>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-3 col-md-6 nopadding-left">
                  <div class="form-group">
                    {!! Form::label('offer_end', trans('app.form.offer_end'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.offer_end') }}"></i>
                    <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                      {!! Form::text('offer_end', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.offer_end')]) !!}
                    </div>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
              </div>
            </fieldset>
            <div class="spacer30"></div>
            @include('admin.inventory._common_sell')
      </div><!-- /.box-body -->
  </div> <!-- /.box -->
</div> <!-- Col-md-8 -->

<div class="col-md-4">  
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">
        Product Settings
      </h3>
      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
    <div class="row">
              <div class="col-lg-3 col-md-6 nopadding-right hidden">
                <div class="form-group">
                  {!! Form::label('warehouse_id', trans('app.form.warehouse'), ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_warehouse') }}"></i>
                  {!! Form::text('warehouse_id',null, ['class' => 'form-control select2', 'placeholder' => trans('app.placeholder.select')]) !!}
                </div>
              </div>
              
              <div class="col-lg-4 col-md-8 nopadding-right">
                <div class="form-group">
                  {!! Form::label('available_from', trans('app.form.available_from'), ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.available_from') }}"></i>
                  <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                    {!! Form::text('available_from', null, ['class' => 'form-control datetimepicker', 'placeholder' => trans('app.placeholder.available_from')]) !!}
                  </div>
                </div>
              </div>
              <div class="col-lg-3 col-md-4 nopadding">
                <div class="form-group">
                  {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.seller_inventory_status') }}"></i>
                  {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], 1, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.select'), 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>
              </div>
              @if(isset($product->requires_shipping))
              <div class="col-lg-5 col-md-6 nopadding-left">
                  <div class="form-group">
                    {!! Form::label('min_order_quantity', trans('app.form.min_order_quantity'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.min_order_quantity') }}"></i>
                    {!! Form::number('min_order_quantity', isset($inventory) ? null : 1, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.min_order_quantity')]) !!}
                  </div>
              </div>
              @endif
            </div>
            @if(isset($product->requires_shipping))
              <div class="row">
                
                <div class="col-lg-6 col-md-6 nopadding-left hidden">
                  <div class="form-group">
                    {!! Form::label('shipping_weight', trans('app.form.shipping_weight'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.shipping_weight') }}"></i>
                    <div class="input-group">
                      {!! Form::number('shipping_weight', null, ['class' => 'form-control', 'step' => 'any', 'placeholder' => trans('app.placeholder.shipping_weight')]) !!}
                      <span class="input-group-addon">{{ config('system_settings.weight_unit') ?: 'gm' }}</span>
                    </div>
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 nopadding-right">
                  <div class="form-group">
                    <label class="with-help">&nbsp;</label>
                    <div class="input-group">
                      {{ Form::hidden('free_shipping', 0) }}
                      {!! Form::checkbox('free_shipping', null, null, ['id' => 'free_shipping', 'class' => 'icheckbox_line']) !!}
                      {!! Form::label('free_shipping', trans('app.form.free_shipping')) !!}
                      <span class="input-group-addon" id="">
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.free_shipping') }}"></i>
                      </span>
                    </div>
                  </div>
                </div>
                <div class="col-lg-6 col-md-6 nopadding-left">
                  <div class="form-group">
                    {!! Form::label('packaging_list[]', trans('app.form.packaging'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.select_packagings') }}"></i>
                    {!! Form::select('packaging_list[]', $packagings , isset($inventory) ? null : config('shop_settings.default_packaging_ids'), ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
                  </div>
                </div>
              </div>
            @endif
      <div class="form-group ">
          {!! Form::label('linked_items[]', trans('app.form.linked_items'), ['class' => 'with-help']) !!}
          <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.inventory_linked_items') }}"></i>
          {!! Form::text('linked_items[]', Null, ['class' => 'form-control select2-normal', 'multiple' => 'multiple']) !!}
          <div class="help-block with-errors"></div>
      </div>

        <!-- SEO Settings -->
        <fieldset>
          <legend>{{ trans('app.seo') }}</legend>
          <div class="form-group">
            {!! Form::label('slug', trans('app.form.slug').'*', ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.slug') }}"></i>
            {!! Form::text('slug', str_replace(' ','-',$title), ['class' => 'form-control slug', 'placeholder' => 'SEO Friendly URL', 'required']) !!}
            <div class="help-block with-errors"></div>
          </div>

          <div class="form-group">
            {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
            {!! Form::text('tag_list[]', 0, ['class' => 'form-control ']) !!}
          </div>

          <div class="form-group">
            {!! Form::label('meta_title', trans('app.form.meta_title'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_title') }}"></i>
            {!! Form::text('meta_title', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_title')]) !!}
          </div>

          <div class="form-group">
            {!! Form::label('meta_description', trans('app.form.meta_description'), ['class' => 'with-help']) !!}
            <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" title="{{ trans('help.meta_description') }}"></i>
            {!! Form::text('meta_description', null, ['class' => 'form-control', 'placeholder' => trans('app.placeholder.meta_description')]) !!}
          </div>
        </fieldset>
        
        <p class="help-block">* {{ trans('app.form.required_fields') }}</p>
        {!! Form::submit(trans('app.form.save'), ['class' => 'btn btn-flat btn-lg btn-new pull-right']) !!}
    </div><!-- /.box-body -->
  </div> <!-- /.box -->
</div> <!-- Col-md-4 -->



