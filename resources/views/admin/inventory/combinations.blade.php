<fieldset>
    <legend>{{ trans('app.variants') }}</legend>
    <table class="table table-default" id="variantsTable">
        <thead>
            <tr>
                <th>{{ trans('app.sl_number') }}</th>
                <th>{{ trans('app.form.variants') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.variants') }}"><sup><i class="fa fa-question"></i></sup></small>
                </th>
                <th>{{ trans('app.form.image') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.variant_image') }}"><sup><i class="fa fa-question"></i></sup></small>
                </th>
                <th>{{ trans('app.form.sku') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.sku') }}"><sup><i class="fa fa-question"></i></sup></small>
                </th>
                <th>{{ trans('app.form.condition') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.seller_product_condition') }}"><sup><i
                                class="fa fa-question"></i></sup></small>
                </th>
                <th>{{ trans('app.form.stock_quantity') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.stock_quantity') }}"><sup><i class="fa fa-question"></i></sup></small>
                </th>
                <th>{{ trans('app.form.purchase_price') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.purchase_price') }}"><sup><i class="fa fa-question"></i></sup></small>
                </th>
                <th>{{ trans('app.form.sale_price') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.sale_price') }}"><sup><i class="fa fa-question"></i></sup></small>
                </th>
                <th>{{ trans('app.form.offer_price') }}
                    <small class="text-muted" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.offer_price') }}"><sup><i class="fa fa-question"></i></sup></small>
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
                <td>
                    <div class="form-group">{{ $i + 1 }}</div>
                </td>
                <td>
                    <div class="form-group">
                        @foreach($combination as $attrId => $attrValue)
                        {{ Form::hidden('variants['. $i .']['. $attrId .']', key($attrValue)) }}
                        {{ $attributes[$attrId] .' : '. current($attrValue) }}
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
                        {!! Form::text('sku['. $i .']', null, ['class' => 'form-control sku', 'placeholder' =>
                        trans('app.placeholder.sku'), 'required']) !!}
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        {!! Form::select('condition['. $i .']', ['New' => trans('app.new'), 'Used' => trans('app.used'),
                        'Refurbished' => trans('app.refurbished')], null, ['class' => 'form-control condition',
                        'required']) !!}
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        {!! Form::number('stock_quantity['. $i .']', null, ['class' => 'form-control quantity',
                        'placeholder' => trans('app.placeholder.stock_quantity'), 'required']) !!}
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        {!! Form::number('purchase_price['. $i .']', null, ['class' => 'form-control purchasePrice',
                        'step' => 'any', 'placeholder' => trans('app.placeholder.purchase_price')]) !!}
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        {!! Form::number('sale_price['. $i .']', null, ['class' => 'form-control salePrice', 'step' =>
                        'any', 'placeholder' => trans('app.placeholder.sale_price'), 'required']) !!}
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        {!! Form::number('offer_price['. $i .']', null, ['class' => 'form-control offerPrice', 'step' =>
                        'any', 'placeholder' => trans('app.placeholder.offer_price')]) !!}
                    </div>
                </td>
                <td>
                    <div class="form-group text-muted">
                        <i class="fa fa-close deleteThisRow" data-toggle="tooltip" data-placement="left"
                            title="{{ trans('help.delete_this_combination') }}"></i>
                    </div>
                </td>
            </tr>
            <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</fieldset>