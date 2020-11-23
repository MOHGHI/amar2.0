<div class="row">

  <div class="col-md-12">
    <div class="form-header hidden">
      <div class="top-header">
        <div class="devider-row">
          <div class="half-2">
            <div class="logo-area">
              <h1><a href="javascript:;">Web Name</a></h1>
            </div>
          </div>
          <div class="half-2">
            <div class="need-help">
              <a href="javascript:;">Need Help <i>?</i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="bottom-header">
        <div class="devider-row">
          <div class="half-2">
            <div class="bars">
              <label>50%</label>
              <span class="active"></span>
              <span class="active"></span>
              <span class="active"></span>
              <span></span>
              <span></span>
              <div class="full-bar"></div>
              <div class="blank-bar"></div>
            </div>
          </div>
          <div class="half-2">
            <div class="status">
              <h5>Status of your app</h5>
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed</p>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="form-body">
      <div class="multitab-form-area">
        <div class="tab-links-area">
          <h1>Add New Product</h1>
          <p>to Amar.pk Catalogue</p>
          <hr>
          <ul>

            <li><a data-toggle="formtab" href="#variation-tab" class="active first-tab">Attributes</a></li>
            <li><a data-toggle="formtab" href="#userProfile" class="second-tab">Basic Info</a></li>
            <li><a data-toggle="formtab" href="#residentailAddress">Images</a></li>
            <li><a data-toggle="formtab" href="#jobDescription">Brand Info</a></li>
            <li><a data-toggle="formtab" href="#bankInfo">Inventory</a></li>
          </ul>
        </div>
        <div class="tab-form-area">
          <!-- Variation Attributes -->
          <div class="tabs-panels active" id="variation-tab">
            <div class="type-wrapper">
              <h3 class="text-center">Select Your Product Type</h3>
              <div class="row product-type-wrapper">
                <div class="col-md-3 col-md-offset-3">
                  <div class="type-wrapper text-center next-step" href="#userProfile">
                    <i class="glyphicon glyphicon-folder-close"></i>
                    <h5 class="text-center">No Variations</h5>
                  </div>
                </div>
                <div class="col-md-3">
                  
                  <div data-toggle="modal" data-target="#variationModal" class="type-wrapper text-center">
                    <i class="glyphicon glyphicon-th"></i>
                    <h5 class="text-center">Product with Variations</h5>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Basic Info Tab -->
          <div class="tabs-panels " id="userProfile">
            <div class="tab-part">
              <h4>Basic Info</h4>
              <hr>
              <div class="devider-row">

                <div class="form-group">
                  <span class="text-danger hidden">Field Required</span>
                  {!! Form::label('category_list[]', trans('app.form.categories').'*') !!}
                  {!! Form::select('category_list[]', $categories , Null, ['class' => 'form-control select2-normal
                  required-filed', 'multiple' => 'multiple', 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                  <span class="text-danger hidden">Field Required</span>
                  {!! Form::label('name', trans('app.form.name').'*', ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                    title="{{ trans('help.product_name') }}"></i>
                  {!! Form::text('name', null, ['class' => 'form-control product-name required-filed', 'placeholder' =>
                  trans('app.placeholder.title'), 'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                  {!! Form::label('active', trans('app.form.status').'*', ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                    title="{{ trans('help.product_active') }}"></i>
                  {!! Form::select('active', ['1' => trans('app.active'), '0' => trans('app.inactive')], !isset($product) ?
                  1 : null, ['class' => 'form-control select2-normal', 'placeholder' => trans('app.placeholder.status'),
                  'required']) !!}
                  <div class="help-block with-errors"></div>
                </div>

                <div class="form-group">
                  <span class="text-danger hidden">Field Required</span>
                  {!! Form::label('description', trans('app.form.description').'*', ['class' => 'with-help']) !!}
                  <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                    title="{{ trans('help.product_description') }}"></i>
                  {!! Form::textarea('description', null, ['class' => 'form-control summernote required-filed', 'rows'
                  => '4', 'placeholder' => trans('app.placeholder.description'), 'required']) !!}
                  <div class="help-block with-errors">{!! $errors->first('description', ':message') !!}</div>
                </div>

                <div class="form-group">
                  {!! Form::label('tag_list[]', trans('app.form.tags'), ['class' => 'with-help']) !!}
                  {!! Form::select('tag_list[]', $tags, null, ['class' => 'form-control select2-tag', 'multiple' =>
                  'multiple']) !!}
                </div>

              </div>
            </div>
            <div class="next-btn">
              <a data-toggle="formtab" href="#residentailAddress">Next</a>
            </div>
          </div>

          <!-- Images Tab -->
          <div class="tabs-panels" id="residentailAddress">
            <div class="tab-part">
              <h4>Images</h4>
              <hr>
              <div class="devider-row">
                <div class="half-1" style="padding: 0 10px;">

                  <legend>
                    {{ trans('app.featured_image') }}
                    <i class="fa fa-question-circle small" data-toggle="tooltip" data-placement="top"
                      title="{{ trans('help.product_featured_image') }}"></i>
                  </legend>
                  @if(isset($product) && $product->featuredImage)
                  <img src="{{ get_storage_file_url($product->featuredImage->path, 'small') }}"
                    alt="{{ trans('app.featured_image') }}">
                  <label>
                    <span style="margin-left: 10px;">
                      {!! Form::checkbox('delete_image', 1, null, ['class' => 'icheck']) !!}
                      {{ trans('app.form.delete_image') }}
                    </span>
                  </label>
                  @endif

                  <div class="row">
                    <div class="col-md-9 nopadding-right">
                      <input id="uploadFile" placeholder="{{ trans('app.featured_image') }}" class="form-control"
                        disabled="disabled" style="height: 28px;" />
                    </div>
                    <div class="col-md-3 nopadding-left">
                      <div class="fileUpload btn btn-primary btn-block btn-flat">
                        <span>{{ trans('app.form.upload') }} </span>
                        <input type="file" name="image" id="uploadBtn" class="upload" />
                      </div>
                    </div>
                  </div>

                  <legend>
                    {{ trans('app.form.images') }}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                      title="{{ trans('help.product_images') }}"></i>
                  </legend>

                  <div class="form-group">
                    <div class="file-loading">
                      <input id="dropzone-input" name="images[]" type="file" accept="image/*" multiple>
                    </div>
                    <span class="small"><i class="fa fa-info-circle"></i>
                      {{ trans('help.multi_img_upload_instruction', ['size' => getAllowedMaxImgSize(), 'number' => getMaxNumberOfImgsForInventory()]) }}</span>
                  </div>



                </div>

              </div>

            </div>
            <div class="next-btn">
              <a data-toggle="formtab" href="#jobDescription">Next</a>
            </div>
          </div>
          
          <!-- Brand Info -->
          <div class="tabs-panels" id="jobDescription">
            <div class="tab-part">
              <h4>Brand Info</h4>
              <hr>
              <div class="devider-row">
                <div class="half-2">
                  <div class="form-group">
                    <label class="with-help">Requires Shippping</label>
                    <div class="input-group">
                      {{ Form::hidden('requires_shipping', 0) }}
                      {!! Form::checkbox('requires_shipping', null, !isset($product) ? 1 : null, ['id' =>
                      'requires_shipping', 'class' => 'icheckbox_line']) !!}
                      {!! Form::label('requires_shipping', trans('app.form.requires_shipping')) !!}
                      <span class="input-group-addon" id="basic-addon1">
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                          title="{{ trans('help.requires_shipping') }}"></i>
                      </span>
                    </div>
                  </div>
                </div>

                @if(auth()->user()->isFromplatform())
                <div class="row">
                  <div class="col-md-6 nopadding-right">
                    <div class="form-group">
                      {!! Form::label('min_price', trans('app.form.catalog_min_price'), ['class' => 'with-help']) !!}
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.catalog_min_price') }}"></i>
                      <div class="input-group">
                        <span class="input-group-addon">{{ get_currency_symbol() }}</span>
                        {!! Form::number('min_price' , null, ['class' => 'form-control', 'step' => 'any', 'min' =>
                        '0','placeholder' => trans('app.placeholder.catalog_min_price')]) !!}
                      </div>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                  <div class="col-md-6 nopadding-left">
                    <div class="form-group">
                      {!! Form::label('max_price', trans('app.form.catalog_max_price'), ['class' => 'with-help']) !!}
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                        title="{{ trans('help.catalog_max_price') }}"></i>
                      <div class="input-group">
                        <span class="input-group-addon">{{ get_currency_symbol() }}</span>
                        {!! Form::number('max_price' , null, ['class' => 'form-control', 'step' => 'any', 'min' => '0',
                        'placeholder' => trans('app.placeholder.catalog_max_price')]) !!}
                      </div>
                      <div class="help-block with-errors"></div>
                    </div>
                  </div>
                </div>
                @endif

                <div class="half-2">
                  <div class="form-group">
                    {!! Form::label('origin_country', trans('app.form.origin'), ['class' => 'with-help']) !!}
                    {!! Form::select('origin_country', $countries , null, ['class' => 'form-control select2',
                    'placeholder' => trans('app.placeholder.origin')]) !!}
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="half-2">
                  <div class="form-group">
                    {!! Form::label('brand', trans('app.form.brand'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                      title="{{ trans('help.brand') }}"></i>
                    {!! Form::text('brand', null, ['class' => 'form-control', 'placeholder' =>
                    trans('app.placeholder.brand')]) !!}
                  </div>
                </div>
                <div class="half-2">
                  <div class="form-group">
                    {!! Form::label('model_number', trans('app.form.model_number'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                      title="{{ trans('help.model_number') }}"></i>
                    {!! Form::text('model_number', null, ['class' => 'form-control', 'placeholder' =>
                    trans('app.placeholder.model_number')]) !!}
                  </div>
                </div>
                <div class="half-2">
                  <div class="form-group">
                    {!! Form::label('manufacturer_id', trans('app.form.manufacturer'), ['class' => 'with-help']) !!}
                    {!! Form::select('manufacturer_id', $manufacturers , null, ['class' => 'form-control select2',
                    'placeholder' => trans('app.placeholder.manufacturer')]) !!}
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="half-2">
                  <div class="form-group">
                    {!! Form::label('mpn', trans('app.form.mpn'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                      title="{{ trans('help.mpn') }}"></i>
                    {!! Form::text('mpn', null, ['class' => 'form-control', 'placeholder' =>
                    trans('app.placeholder.mpn')]) !!}
                  </div>
                </div>
                <div class="half-2">
                  <div class="form-group">
                    {!! Form::label('gtin', trans('app.form.gtin'), ['class' => 'with-help']) !!}
                    <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top"
                      title="{{ trans('help.gtin') }}"></i>
                    {!! Form::text('gtin', null, ['class' => 'form-control', 'placeholder' =>
                    trans('app.placeholder.gtin')]) !!}
                  </div>
                </div>
                <div class="half-2">
                  <div class="form-group">
                    {!! Form::label('gtin_type', trans('app.form.gtin_type'), ['class' => 'with-help']) !!}
                    {!! Form::select('gtin_type', $gtin_types , null, ['class' => 'form-control select2', 'placeholder'
                    => trans('app.placeholder.gtin_type')]) !!}
                  </div>
                </div>
              </div>
            </div>
            <div class="next-btn">
              <a data-toggle="formtab" href="#bankInfo">Next</a>
            </div>
          </div>

          <!-- Inventory Info -->
          <div class="tabs-panels" id="bankInfo">
            <div class="tab-part">
              <h4>Inventory</h4>
              <hr>
              <div class="devider-row hidden">
                <div class="form-group">
                  {!! Form::label('varient', trans('app.form.has_variant').'*') !!}
                  <div class="input-group has-variant-group"> 
                    {{ Form::hidden('has_variant', 0) }}
                    {!! Form::checkbox('has_variant', null, !isset($product) ? 1 : 0, ['id' => 'has_variant', 'class'
                    => 'icheckbox_line']) !!}
                    {!! Form::label('has_variant', trans('app.form.has_variant')) !!}
                    <span class="input-group-addon" id="basic-addon1">
                      <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="left"
                        title="{{ trans('help.has_variant') }}"></i>
                    </span>
                    <div class="form-group add-variations hidden">
                      <button type="button" class="btn btn-primary btn-flat" data-toggle="modal" data-target="#variationModal" >Add Variations</button>
                    </div>
                  </div>
                </div>
                
              </div>
              @include('admin.inventory._form')
              <div id="combinations"></div>
            </div>
            <div class="next-btn">
              {!! Form::submit( isset($product) ? trans('app.form.update') : trans('app.form.save'), ['class' => 'btn
              btn-flat btn-lg btn-primary']) !!}
              <!-- <button type="button" class="btn btn-primary btn-flat btn-lg create-combinations">Next</button> -->
            </div>
          </div>

          <div class="note">
            <p>* You must fill all blank spaces.</p>
          </div>
        </div>
      </div>
    </div>

    <div class="form-footer">
      <p>Lorem ipsum dolor sit amet, consectetur. 2018-19 all rights are reserved.</p>
    </div>

  </div>

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css?family=Roboto:400,700');

    * {
      box-sizing: border-box;
    }

    button:active,
    button:focus {
      outline: none;
      box-shadow: none;
    }

    body {
      background: #eeffad;
      ;
      font-family: 'Roboto', sans-serif;
    }

    .multitab-form-area {
      max-width: 100%;
      margin: 0 auto;
      background: #eee;
      padding: 20px
    }

    .form-field input:focus,
    .form-field input:active,
    .form-field select:focus,
    .form-field select:active,
    .form-field textarea:active,
    .form-field textarea:focus {
      outline: 1px solid #8aa71c;
    }

    .tab-links-area {
      width: 240px;
      display: inline-block;
      vertical-align: top;
      padding-right: 20px;
    }

    .tab-form-area {
      width: calc(100% - 245px);
      display: inline-block;
      background: #fff;
      vertical-align: top;
      padding: 16px;
      border-radius: 5px;
    }

    .tab-links-area p {
      margin: 0;
      font-size: 14px;
      color: #999;
    }

    .tab-links-area h1 {
      margin: 0;
      font-size: 24px;
    }

    .tab-part h4 {
      font-size: 24px;
      margin: 0;
    }

    .multitab-form-area hr {
      border: 0;
      height: 1px;
      width: 100%;
      background: rgba(0, 0, 0, 0.3);
    }

    .tab-links-area ul li a {
      text-decoration: none;
      font-size: 14px;
      padding: 10px 15px;
      display: block;
      color: #333;
      position: relative;
    }

    .tab-links-area ul li a:before {
      content: '';
      height: 0%;
      width: 3px;
      background: #8aa71c;
      position: absolute;
      left: -2px;
      top: 0;
      bottom: 0;
      margin: auto;
      transition: 0.3s ease;
    }

    .tab-links-area ul li a.active:before {
      height: 100%;
    }

    .tab-links-area ul li {
      display: block;
      border-left: 1px solid #eee;
    }

    .tab-links-area ul {
      list-style: none;
      padding: 0;
      margin: 20px 0 0;
    }

    .form-field input,
    .form-field select {
      width: 100%;
      font-family: 'Roboto', sans-serif;
      height: 35px;
      padding-left: 10px;
      border: 1px solid #ccc;
    }

    .form-field select {
      padding: 0 0 0 2px;
    }

    .form-field label {
      font-size: 14px;
      display: block;
      padding: 10px 0;
    }

    .half-2 {
      width: 50%;
      padding: 0 10px;
      float: left;
    }

    .devider-row:after {
      content: '';
      display: table;
      clear: both;
    }

    .devider-row {
      margin: 0 -10px;
      clear: both;
    }

    .half-3 {
      width: calc(100%/3);
      float: left;
      padding: 0 10px;
    }

    .next-btn button,
    .next-btn a {
      background: #177b41;
      cursor: pointer;
      border: 1px solid #177b41;
      transition: 0.3s ease;
      color: #fff;
      height: 35px;
      width: 90px;
      border-radius: 100px;
      margin: 20px 0 10px auto;
      display: block;
      text-transform: uppercase;
      text-align: center;
      line-height: 35px;
      text-decoration: none;
      font-size: 14px;
    }

    .next-btn button:hover,
    .next-btn a:hover {
      background: transparent;
      color: #8aa71c;
    }

    .tabs-panels.active {
      display: block;
    }

    .tabs-panels {
      display: none;
      animation: fadeIn 0.3s ease;
    }

    .full {
      padding: 0 10px;
      width: 100%;
    }

    .form-field textarea {
      width: 100%;
      height: 100px;
      padding: 10px;
      font-size: 14px;
      border: 1px solid #ccc;
      font-family: 'Roboto', sans-serif;
    }

    .checkbox label:after {
      content: '';
      position: absolute;
      border-style: solid;
      border-color: #333;
      height: 8px;
      width: 5px;
      border-width: 0 3px 3px 0;
      left: 5px;
      z-index: 2;
      transform: rotate(35deg);
      top: 4px;
      display: none;
    }

    .checkbox label:before {
      content: '';
      height: 20px;
      width: 21px;
      background: #fff;
      position: absolute;
      border: 1px solid #8aa71c;
      left: -2px;
      top: 0;
      border-radius: 3px;
    }

    .checkbox {
      position: relative;
      margin: 10px 0;
    }

    .checkbox label {
      display: inline-block;
      vertical-align: middle;
      padding: 0;
    }

    .checkbox input[type="checkbox"] {
      width: 20px;
      height: 20px;
      display: inline-block;
      vertical-align: middle;
      margin: 0;
      position: relative;
      z-index: 3;
      opacity: 0;
    }

    .radio label:after {
      content: '';
      display: none;
      height: 15px;
      width: 15px;
      position: absolute;
      background: #8aa71c;
      border-radius: 100px;
      left: 2px;
      top: 2px;
      z-index: 1;
    }

    .radio label:before {
      content: '';
      height: 21px;
      width: 21px;
      background: #fff;
      border: 1px solid #8aa71c;
      position: absolute;
      left: -2px;
      top: -2px;
      border-radius: 100px;
    }

    .radio input[type="radio"] {
      height: 20px;
      width: 20px;
      display: inline-block;
      margin: 0;
      position: relative;
      z-index: 3;
      opacity: 0;
      vertical-align: middle;
    }

    .radio label {
      padding: 0;
      display: inline-block;
      margin: 0;
      vertical-align: middle;
    }

    .radio {
      position: relative;
      margin: 10px 0;
    }

    .radio input:checked+label:after,
    .checkbox input:checked+label:after {
      display: block;
    }

    .note p {
      margin: 0;
      font-size: 12px;
      color: #999;
    }

    .form-area {
      max-width: 80%;
      margin: 0 auto;
      background: #eee;
      border-radius: 10px;
      overflow: hidden;
      box-shadow: 0 5px 20px rgba(0, 0, 0, 0.25)
    }

    .form-footer p {
      margin: 0;
      font-size: 12px;
    }

    .form-footer {
      padding: 20px;
      text-align: center;
      color: #676767;
    }

    .form-header {
      background: #fff;
      box-shadow: 0 2px 7px rgba(0, 0, 0, 0.1);
      margin-bottom: 20px;
    }

    .logo-area {
      padding: 0 10%;
    }

    .logo-area h1 a {
      color: #000;
      text-decoration: none;
      outline: none;
    }

    .logo-area h1 {
      margin: 0;
      font-size: 18px;
    }

    .need-help a i {
      background: #333;
      color: #fff;
      font-style: normal;
      font-size: 10px;
      height: 13px;
      width: 13px;
      display: inline-block;
      text-align: center;
      border-radius: 100px;
    }

    .need-help a {
      font-size: 12px;
      color: #333;
      text-decoration: none;
    }

    .need-help {
      text-align: right;
      padding: 0 10%;
    }

    .top-header {
      padding: 15px 0;
      border-bottom: 2px dashed #ccc;
    }

    .status p {
      font-size: 12px;
      color: #676767
    }

    .status h5,
    .status p {
      margin: 0;
    }

    .bars label {
      text-align: center;
      display: block;
      font-size: 14px;
    }

    .bars {
      position: relative;
    }

    .blank-bar {
      width: 100%;
      background: #ccc;
      height: 3px;
      border-radius: 100px;
    }

    .full-bar {
      width: 50%;
      background: #8aa71c;
      height: 3px;
      position: relative;
      bottom: -3px;
    }

    .bars span {
      height: 8px;
      width: 8px;
      display: inline-block;
      position: absolute;
      background: #ccc;
      border-radius: 100px;
      z-index: 1;
    }

    .bars span:nth-of-type(2) {
      left: 15%;
    }

    .bars span:nth-of-type(3) {
      left: 50%;
    }

    .bars span:nth-of-type(4) {
      left: 85%;
    }

    .bars span:nth-of-type(5) {
      left: 100%;
    }

    .bars span.active {
      background: #8aa71c;
    }

    .bottom-header {
      padding: 15px 10%;
    }

    .status {
      padding-left: 10%;
    }

    .field-danger {
      border-color: red;
    }

    .tab-form-area {
      width: calc(100% - 245px);
      display: inline-block;
      background: #fff;
      vertical-align: top;
      padding: 16px;
      border-radius: 5px;
      min-height: 91vh;
      position: relative;
    }

    .next-btn {
      position: absolute;
      bottom: 1rem;
      right: 1rem;
    }

    /*keyframes*/
    @-webkit-keyframes fadeIn {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }

    @keyframes fadeIn {
      0% {
        opacity: 0;
      }

      100% {
        opacity: 1;
      }
    }

    .fadeIn {
      -webkit-animation-name: fadeIn;
      animation-name: fadeIn;
    }

    @media(max-width:750px) {
      .half-2 {
        width: 100%;
      }

      .top-header .half-2 {
        width: 50%;
      }

      .logo-area {
        padding: 0 5%;
        text-align: left;
      }

      .status {
        padding-top: 20px;
        padding-left: 0;
      }
    }

    @media(max-width:570px) {
      .tab-links-area {
        width: 100%;
        display: block;
        margin-bottom: 20px;
      }

      .tab-form-area {
        width: 100%;
      }

      .bottom-header {
        padding: 15px 5%;
      }
    }

    @media(max-width:420px) {
      .form-area {
        max-width: 90%;
      }
    }

    .form-body {
      padding: 0px;
      width: 100%;
      margin: 0rem auto;
      min-height:95vh;
    }

    .form-group.add-variations button {
    margin: 0 !important;
    height: 34px;
  }

  .form-group.add-variations {
      margin: 0;
      flex: 0 20%;
  }

  .input-group.has-variant-group {
      display: flex;
  }

  .input-group.has-variant-group .icheckbox_line-pink {
      flex: 0 100%;
  }

  .input-group.has-variant-group .input-group-addon {
      flex: 0 5%;
  }
  </style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

  <script type="text/javascript">
    var validated = 1;
    $('a[data-toggle="formtab"]').click(function (e) {
      e.preventDefault();

      $(this).closest('.tabs-panels.active').find('.required-filed').each(function () {
        if (!$(this).val()) {
          $(this).closest('.form-group').find('.text-danger').removeClass('hidden');
          validated = 0;
        } else {
          $(this).closest('.form-group').find('.text-danger').addClass('hidden');
          validated = 1;
        }
        // alert('kk')
      })

      if (validated) {
        var targetId = $(this).attr('href');
        $('.tabs-panels').removeClass('active')
        $('a[data-toggle="formtab"]').removeClass('active');
        $(targetId).addClass('active');
        $('a[href="' + targetId + '"]').addClass('active')
      }

    });
    function createCombinations() {
      $.ajax({
        type: 'POST',
        url: '/inventory/combinations',
        data: '',
        success: function (data) {
          $("#msg").html(data.msg);
        }
      });
    }


    $('.product-name').change(function(){
      $('.slug').val($(this).val().replace(' ','-'))
    })

    $('.next-step').click(function(){
      $(this).removeClass('active');
      $('.first-tab').removeClass('active')
      $('#variation-tab').removeClass('active')
      $('.second-tab').addClass('active')
      $('#variations').hide()
      $($(this).attr('href')).addClass('active')
      $('#has_variant').prop('checked', true)
      $('input[name="has_variant"]').val(0)
    })
  </script>
  <!-- =========================================== -->

</div>
</div>
</div>